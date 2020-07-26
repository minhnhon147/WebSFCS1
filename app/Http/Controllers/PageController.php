<?php

namespace App\Http\Controllers;
use App\Slide;
use App\Product;
use App\ProductType;
use App\Cart;
use App\Customer;
use App\Bill;
use App\BillDetail;
use Session;
use Illuminate\Http\Request;

use Socialite; //sử dụng Socialite
use App\User;
use Hash;
use Auth;

class PageController extends Controller
{
    public function getIndex(){
        $slide = Slide::all();
        $new_product=Product::where('new',1)->paginate(8);
    	
    	return view('page.trangchu',compact('slide','new_product'));//,['product'=>$product]);
    }

    public function getLoaisp($type){
        $sp_theoloai = Product::where('id_type',$type)->get();
        $sp_khac=Product::where('id_type','<>',$type)->paginate(3);
        $loai=ProductType::all();
        $loai_sp=ProductType::where('id',$type)->first();
    	return view('page.loai_sanpham',compact('sp_theoloai','sp_khac','loai','loai_sp'));
    }

    public function getChitiet($id){
        $new_product=Product::where('new',1)->limit(4)->get();
        $product=Product::find($id);
        $new_id_type = $product->id_type;
        $sp_khac=Product::where('id_type','<>',$new_id_type)->limit(4)->get();

        $productAll= Product::where('id_type' , $new_id_type)->limit(3)->get();
        // dd($product);

    	return view('page.chitiet_sanpham',[
            'id_type' =>  $new_id_type,
            'product' => $product,
            'productAll' => $productAll,
            'new_product'=>$new_product,
            'sp_khac'=>$sp_khac
        ]);
    }


    public function getLienHe(){
    	return view('page.lienhe');
    }

    public function getGioiThieu(){
    	return view('page.gioithieu');
    }

    public function getAddtoCart(Request $reg,$id){
        $product=Product::find($id);
        $oldCart=Session('cart')?Session::get('cart'):null;
        $cart=new Cart($oldCart);
        $cart->add($product,$id);
        $reg->Session()->put('cart',$cart);
        return redirect()->back();
    }

    public function getDelItemCart($id){
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart=new Cart($oldCart);
        $cart->removeItem($id);
        Session::put('cart',$cart);
        return redirect()->back();
    }
    public function getDatHang(){   
        return view('page.dat_hang');
    }

    public function postCheckout(Request $req){
        $cart = Session::get('cart');
        $customer = new Customer;
        $customer->name = $req->name;
        $customer->gender = $req->gender;
        $customer->email = $req->email;
        $customer->address=$req->address;
        $customer->phone_number=$req->phone;
        $customer->note=$req->notes;
        $customer->save();

        $bill= new Bill;
        $bill->id_customer=$customer->id;
        $bill->date_order=date('Y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment=$req->payment;
        $bill->note=$req->notes;
        $bill->save();

        foreach($cart->items as $key => $value){
            $bill_detail=new BillDetail;
            $bill_detail->id_bill=$bill->id;
            $bill_detail->id_product=$key;
            $bill_detail->quantity = $value['qty'];
            $bill_detail->unit_price=($value['price']/$value['qty']);
            $bill_detail->save();
        }
        Session::forget('cart');
        return redirect()->back()->with('thongbao','Đặt hàng thành công');
    }

    public function getLogin(){
        return view('page.dangnhap');
    }

    public function getSignin(){
        return view('page.dangki');
    }

    public function getSearch(Request $req){
        $product = Product::where('name','like','%'.$req->key.'%')
                ->orWhere('unit_price',$req->key)
                ->get();
            return view('page.search',compact('product'));
    }

    public function postSignin(Request $req){
        $this->validate($req,
            [

                'email'=>'required|email|unique:users,email',
                'password'=> 'required|min:6|max:20',
                'fullname'=>'required',
                're_password'=> 'required|same:password'
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Không đúng định dạng email',
                'email.unique'=>'Email bị trùng lặp',
                'password.required'=>'Vui lòng nhập mật khẩu',
                're_password.same'=>'Mẩu khẩu không giống nhau',
                'password.min'=>'Mật khẩu ít nhất 6 ký tự'
            ]
        );
        $user= new User();
        $user->full_name=$req->fullname;
        $user->email=$req->email;
        $user->password=Hash::make($req->password);
        $user->phone=$req->phone;
        $user->address=$req->address;
        $user->save();
        return redirect()->back()->with('thanhcong','Tạo tài khoản thành công!');
    }


    public function postLogin(Request $req){
        $this ->validate($req,
            [
                'email'=>'required|email',
                'password'=>'required|min:6|max:20'       
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Email không đúng định dạng',
                'password.required'=>'Vui lòng nhập mật khẩu'
            ]);
        $credentials = array('email'=>$req->email,'password'=>$req->password);
        if(Auth::attempt($credentials))
        {
            return redirect()->back()->with(['flag'=>'success','message'=>'Đăng nhập thành công!']);
        }
        else
        {
            return redirect()->back()->with(['flag'=>'danger','message'=>'Đăng nhập không thành công :(']);
        }
    }


    public function getLogout(){
        Auth::logout();
        return redirect('index');
    }

    
}
