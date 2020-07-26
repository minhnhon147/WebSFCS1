<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use Hash;


class UserController extends Controller
{
    public function getList(){
        $users=User::all();
    
    	return view('admin.users.list',compact('users'));
    }

    public function getEdit($id)
    {
        $user = User::find($id);
       
        return view('admin.users.edit', compact('user'));
    }

    public function postEdit(Request $req,$id)
    {
        $this->validate($req,
        [

            'email'=>'required|email|unique:users,email',
            'password'=> 'required|min:6|max:20',
            
        ],
        [
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Không đúng định dạng email',
            'email.unique'=>'Email bị trùng lặp',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'password.min'=>'Mật khẩu ít nhất 6 ký tự'
        ]
    );
        $user = User::find($id);
      
        $user->full_name = $req->full_name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->phone=$req->phone;
        $user->address=$req->address;
        
            $user->save();  
        return redirect('admin/users/edit/'.$id)->with('thongbao','Sửa thành công');
    }

    
 
}