<?php

namespace App\Http\Controllers;


use App\Country;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;



class UsersController extends Controller
{

    public function userLoginRegister(){
        return view('users.login_register');
    }

    public function login(Request $request){
        if ($request->isMethod('post')){
            $data = $request->all();
            if (Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                Session::put('frontSession',$data['email']);

                if(!empty(Session::get('session_id'))){
                    $session_id = Session::get('session_id');
                    DB::table('cart')->where('session_id',$session_id)->update(['user_email'=>$data['email']]);
                }

                return redirect('/')->with('flash_message_success', 'Logged In with success');
            }
            else{
                return redirect()->back()->with('flash_message_error','Invalid Username or Password');
            }
        }
    }

    public function forgotPassword(Request $request){
        if ($request->isMethod('post')){
            $data = $request->all();
            $userCount = User::where('email',$data['email'])->count();
            if($userCount == 0){
                return redirect()->back()->with('flash_message_error','Email does not exist!');
            }

            //Get User Details
            $userDetails = User::where('email',$data['email'])->first();

            //Generate Random Password
            echo $random_password = Str::random(8);

            //Encode/Secure Password
            $new_password = bcrypt($random_password);

            //Update Password
            User::where('email',$data['email'])->update(['password'=>$new_password]);

            //Send Forgot Password Email Code
            $email = $data['email'];
            $name = $userDetails->name;
            $messageData = [
                'email'=>$email,
                'name'=>$name,
                'password'=>$new_password
            ];
            // ESTE COMANDO ESTÁ COMENTADO, POIS NÃO É POSSÍVEL ENVIAR O EMAIL SEM TER DADOS DE ENVIO DO SERVIDOR NO ENV
//            Mail::send('emails.forgotpassword',$messageData,function ($message)use($email){
//                $message->to($email)->subject('New Password - Sports E-Shopper');
//            });
            return redirect('login-register')->with('flash_message_success','Please check your email for new password');
        }
        return view('users.forgot_password');
    }


    public function register(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();
            //Check if user exists
            $usersCount = User::where('email', $data['email'])->count();
            if ($usersCount > 0) {
                return redirect()->back()->with('flash_message_error', 'Email already exists');
            } else {
                $user = new User;
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->save();
                if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                    Session::put('frontSession',$data['email']);

                    if(!empty(Session::get('session_id'))){
                        $session_id = Session::get('session_id');
                        DB::table('cart')->where('session_id',$session_id)->update(['user_email'=>$data['email']]);
                    }

                    return redirect('/')->with('flash_message_success', 'User registered with success');
                }

            }
        }
    }

    public function account(Request $request){
        $user_id = Auth::User()->id;
        $userDetails = User::find($user_id);
        $countries = Country::get();
        if ($request->isMethod('post')){
            $data = $request->all();

            if (empty($data['name'])){
                return redirect()->back()
                    ->with('flash_message_error','Please enter your name to update your account details');
            }
            if (empty($data['address'])){
                return redirect()->back()
                    ->with('flash_message_error','Please enter your address to update your account details');
            }
            if (empty($data['city'])){
                return redirect()->back()
                    ->with('flash_message_error','Please enter your city to update your account details');
            }
            if (empty($data['country'])){
                return redirect()->back()
                    ->with('flash_message_error','Please enter your country to update your account details');
            }
            if (empty($data['zipcode'])){
                return redirect()->back()
                    ->with('flash_message_error','Please enter your zipcode to update your account details');
            }
            if (empty($data['phone'])){
                return redirect()->back()
                    ->with('flash_message_error','Please enter your phone to update your account details');
            }
            $user = User::find($user_id);
            $user->name = $data['name'];
            $user->address = $data['address'];
            $user->city = $data['city'];
            $user->country = $data['country'];
            $user->zipcode = $data['zipcode'];
            $user->phone = $data['phone'];
            $user->save();
            return redirect()->back()->with('flash_message_success','Your account details have been updated');
        }
        return view('users.account')->with(compact('countries','userDetails'));
    }

    public function chkUserPassword(Request $request){
        $data = $request->all();
        $current_password = $data['current_pass'];
        $user_id = Auth::User()->id;
        $check_password = User::where('id', $user_id)->first();
        if(Hash::check($current_password,$check_password->password)){
            echo "true";die;
        }
        else{
            echo "false";die;
        }
    }

    public function updatePassword(Request $request){
        if ($request->isMethod('post')){
            $data = $request->all();
            $old_password= User::where('id',Auth::User()->id)->first();
            $current_password = $data['current_pass'];
            if(Hash::check($current_password,$old_password->password)){
                $new_pass = bcrypt($data['new_pass']);
                User::where('id',Auth::User()->id)->update(['password'=>$new_pass]);
                return redirect()->back()->with('flash_message_success','Password updated with success!');
            }else{
                return redirect()->back()->with('flash_message_error','Current password is incorrect!');
            }
        }
    }


    public function logout(){
        Auth::logout();
        Session::forget('frontSession');
        Session::forget('session_id');
        return redirect('/');

    }

    public function checkEmail(Request $request)
    {
        $data = $request->all();
        // Check if user already exists
        $usersCount = User::where('email', $data['email'])->count();
        if ($usersCount > 0) {
            echo "false";
        }

    }
}
