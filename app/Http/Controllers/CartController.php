<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Coupon;
use Illuminate\Support\Facades\Session;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;

class CartController extends Controller
{
    public function cartPage()
    {
        $carts=Cart::content();
        $total_price=Cart::subtotal();
        // return $carts;
        // return view('product.checkout',compact('carts','total_price'));
        return view('product.cart',compact('carts','total_price'));
    }

    public function addToCart(Request $request)
    {
        // dd($request->all());
        $id = $request->product_id;
        $order_qty = $request->order_qty;
        $product=DB::table('db_items')->where('id',$id)->first();
        Cart::add([
            'id'=>$product->id,
            'name'=>$product->item_name,
            'price'=>$product->sales_price,
            'weight'=>0,
            'product_stock'=>$product->stock,
            'qty'=>$order_qty,
            'options'=>[
                'product_image' => $product->item_image
            ]
        ]);
        return back();

    }
    /*======= removeFromCart =======*/
    public function removeFromCart($cart_id)
    {
        Cart::remove($cart_id);
        // Toastr::info('Product Removed from Cart!!');
        return back();
    }

    public function couponApply(Request $request)
    {
        //dd($request->all());
        $check=Coupon::where('cupon_code',$request->cupon_code)->first();
        // print_r($check->discount);
        // print_r(Cart::subtotal());
        $cartsubtotal=str_replace(",", "", Cart::subtotal());
        //if session got existing coupon, then don't allow double coupon
        if(Session::get('coupon')){
            Toastr::error('Already Applied coupon!!','Info!!');
            return redirect()->back();
        }

        //if valid coupon found
        if($check !=null){
            //check coupon validity
            $check_validity=$check->finish_date>Carbon::now()->format('Y-m-d');
            //if coupon date is not expried
            if($check_validity && $check->discount_type==0){
                Session::put('coupon',[
                    'cupon_code'=>$check->cupon_code,
                    'discount'=>($cartsubtotal * $check->discount)/100,
                    'cart_total'=> $cartsubtotal,
                    'balance'=> $cartsubtotal - ($cartsubtotal * $check->discount)/100
                ]);
                Toastr::success('Coupon Percentage Applied!!','Successfully!!');
                return redirect()->back();
            }else if($check_validity && $check->discount_type==1){
                Session::put('coupon',[
                    'cupon_code'=>$check->cupon_code,
                    'discount'=>$check->discount,
                    'cart_total'=> $cartsubtotal,
                    'balance'=> $cartsubtotal - $check->discount
                ]);
                Toastr::success('Coupon Percentage Applied!!','Successfully!!');
                return redirect()->back();
            }else{
                Toastr::error('Coupon Date Expire!!!','Info!!');
                return redirect()->back();
            }
        }else{
            Toastr::error('Invalid Action/Coupon! Check, Empty Cart');
            return redirect()->back();
        }
    }

    public function removeCoupon($cupon_code)
    {
        Session::forget('coupon');
        Toastr::success('Coupon Removed','Successfully!!');
        return redirect()->back();
    }

}
