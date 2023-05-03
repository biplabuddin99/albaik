<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Billing;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\StockEntry;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Exception;

class CheckoutController extends Controller
{
    public function checkoutPage()
    {
        $carts=Cart::content();
        $total_price=Cart::subtotal();
        $districts=District::select('id','name','bn_name')->get();
        return view('product.checkout',compact('carts','total_price','districts'));
    }

    public function loadUpazillaAjax($district_id)
    {
        $upazilas=Upazila::where('district_id',$district_id)->select('id','name')->get();
        return response()->json($upazilas,200);
    }


    public function placeOrder(Request $request)
    {
        // dd($request->all());
        try {
            $billing = new Billing;
            $billing->name=$request->full_name;
            $billing->email=$request->email;
            $billing->phone_number=$request->contact;
            $billing->district_id=$request->district_id;
            $billing->upazila_id=$request->upazila_id;
            $billing->address=$request->shipping_address;
            $billing->order_notes=$request->order_note;
            $billing->payment_method=$request->payment_method;
            if($billing->save()){
                $order=new Order;
                $order->user_id=$request->session()->get('userId');
                $order->billing_id=$billing->id;
                $order->sub_total=Session::get('coupon')['cart_total']??Cart::subtotal();
                $order->discount_amount=Session::get('coupon')['discount_amount']?? 0;
                $order->coupon_name=Session::get('coupon')['name']?? '';
                $order->total=Session::get('coupon')['balance']?? Cart::subtotal();
                $order->status=0;
                if($order->save()){

                    //Order details table data insert using cart_items helpers
                    foreach(Cart::content() as $cart_item) {
                        $orderdetails= new OrderDetails;
                        $orderdetails->order_id=$order->id;
                        $orderdetails->user_id=$request->session()->get('userId');
                        $orderdetails->product_id=$cart_item->id;
                        $orderdetails->product_qty=$cart_item->qty;
                        $orderdetails->product_price=$cart_item->price;
                        StockEntry::findOrFail($cart_item->id)->decrement('qty', $cart_item->qty);
                        // DB::table('db_stockentry')->findOrFail($cart_item->id)->decrement('qty', $cart_item->qty);
                        if($orderdetails->save()){
                            // Toastr::success('Your Order placed successfully!!!!','Success');
                            // return redirect()->route('home');
                        }else{
                            return back();
                        }
                    }
                    Cart::destroy();
                    Session::forget('coupon');
                    return redirect()->route('home');
                }else{
                    return back();
                }
                return back();
            }else{
            return redirect()->back()->with('please try again');
            }

        }catch(Exception $e){
            dd($e);
        }
    }
}
