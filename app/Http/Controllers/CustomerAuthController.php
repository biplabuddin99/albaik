<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerSigninRequest;
use App\Http\Requests\CustomerSignupRequest;
use App\Models\CustomerAuth;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Traits\ResponseTrait;
use Illuminate\Support\Facades\Crypt;
use Exception;
use Session;

class CustomerAuthController extends Controller
{
    use ResponseTrait;

    public function SingUpForm()
    {
        return view('authentication.register');
    }

    public function signUpStore(CustomerSignupRequest $request)
    {
        try {
            $customer = new CustomerAuth;
            $customer->first_name=$request->first_name;
            $customer->last_name=$request->last_name;
            $customer->contact=$request->contact;
            $customer->shipping_address=$request->shipping_address;
            $customer->email=$request->email;
            $customer->image='avater.jpg';
            $customer->password=Crypt::encryptString($request->password);
            $customer->check_me_out=$request->check_me_out;
            if($customer->save()){
            return redirect(route('login'));
            }else{
            return redirect()->back()->with('please try again');
            }

        }catch(Exception $e){
            dd($e);
        }
    }

    public function ProfileEdit()
    {
        $id=Session::get('userId');
       $customer=CustomerAuth::findOrFail($id);
    //    return $customer;
       return view('authentication.customer_update',compact('customer'));
    }

    public function AllOrderList()
    {
        $id=Session::get('userId');
       $allorder=Order::where('user_id',$id)->get();;
       return view('product.allorder_list',compact('allorder'));
    }

    public function update(Request $request)
    {
        try {
            $id=Session::get('userId');
            $customer=CustomerAuth::findOrFail($id);
            $customer->first_name=$request->first_name;
            $customer->last_name=$request->last_name;
            $customer->contact=$request->contact;
            $customer->shipping_address=$request->shipping_address;
            if($request->hasFile('image')){
                $imageName = rand(111,999).time().'.'.$request->image->extension();
                $request->image->move(public_path('uploads/customer_img'), $imageName);
                $customer->image=$imageName;
            }
            $customer->save();
            request()->session()->put(
                [
                    'userId'=>$customer->id,
                    'userName'=>$customer->first_name." ".$customer->last_name,
                    'shippingAddress'=>$customer->shipping_address,
                    'Phone'=>$customer->contact,
                    'Image'=>$customer->image?$customer->image:'avater.jpg'
                ]);
            return redirect()->route('customer.dashboard');
        } catch (Exception $e) {
            Toastr::info('Please try Again!');
            // dd($e);
        }
    }

    public function SinInForm(){
        return view('authentication.login');
    }

    public function customerLoginCheck(CustomerSigninRequest $request)
    {
        try {
            $customer = CustomerAuth::where('email', $request->email)->first();
            if ($customer) {
                if ($request->password === Crypt::decryptString($customer->password)) {
                    $this->setSession($customer);
                    return redirect()->route('customer.dashboard')->with($this->resMessageHtml(true, null, 'Successfully login'));
                } else
                    return redirect()->route('login')->with($this->resMessageHtml(false, 'error', 'wrong cradential! Please try Again'));
            } else {
                return redirect()->route('login')->with($this->resMessageHtml(false, 'error', 'wrong cradential!. Or no user found!'));
            }
        } catch (Exception $error) {
            dd($error);
            return redirect()->route('login')->with($this->resMessageHtml(false, 'error', 'wrong cradential!'));
        }
    }

    public function setSession($customer){
        return request()->session()->put(
                [
                    'userId'=>$customer->id,
                    'userName'=>$customer->first_name." ".$customer->last_name,
                    'userEmail'=>$customer->email,
                    'shippingAddress'=>$customer->shipping_address,
                    'Phone'=>$customer->contact,
                    'language'=>$customer->language,
                    'Image'=>$customer->image?$customer->image:'no-image.png'
                ]
            );
    }

    public function singOut(){
        request()->session()->flush();
        return redirect('login')->with($this->resMessageHtml(false,'error','successfully Logout'));
    }

}
