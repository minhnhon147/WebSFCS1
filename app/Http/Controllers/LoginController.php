<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Social; //sử dụng model Social
use Socialite; //sử dụng Socialite
use App\Login; //sử dụng model Login
use Session;
use Auth;
use App\User;
use Hash;

//use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    //
    public function login_google(){
        return Socialite::driver('google')->redirect();
   }
	public function callback_google(){
        $users = Socialite::driver('google')->stateless()->user(); 
        // return $users->id;
        $authUser = $this->findOrCreateUser($users,'google');
        
        $credentials = array('email'=>$users->email,'password'=>$users->email);
        if(Auth::attempt($credentials))
        {
            return redirect('index')->with('message', 'Đăng nhập Google thành công !');
        }
        else
        {
            return redirect('dang-nhap')->with('message','Đăng nhập Google không thành công !');
        }

        



        return redirect('index')->with('message', 'Đăng nhập Google thành công');
      
       
    }
    public function findOrCreateUser($users,$provider){
        $authUser = Social::where('provider_user_id', $users->id)->first();
        if($authUser){
            
            return $authUser;
        }
      
        $new_user = new Social([
            'provider_user_id' => $users->id,
            'provider' => strtoupper($provider)
        ]);

        $orang = Login::where('admin_email',$users->email)->first();

            if(!$orang){
                $orang = Login::create([
                    'admin_name' => $users->name,
                    'admin_email' => $users->email,
                    'admin_password' => '',

                    'admin_phone' => '',
                    'admin_status' => 1
                ]);
            }
        $new_user->login()->associate($orang);
        $new_user->save();

        $new_user2= new User();
        $new_user2->full_name=$users->name;
        $new_user2->email=$users->email;
        $new_user2->password=Hash::make($users->email);
        $new_user2->phone='';
        $new_user2->address='';
        $new_user2->save();

        $account_name = Login::where('admin_id',$new_user->user)->first();
        Session::put('admin_name',$account_name->admin_name);
        Session::put('admin_id',$account_name->admin_id);
        


        return redirect('index')->with('message1', 'Đăng nhập Google lần đầu thành công');


    }

}
