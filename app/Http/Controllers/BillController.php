<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\BillDetail;
use App\Product;
use Illuminate\Support\Str;


class BillController extends Controller
{
    public function getList(){
        $bills = Bill::orderBy('id','DESC')->get();
    
    	return view('admin.bills.list',compact('bills'));
    }

    public function getDetail($id)
    {
        $billDetail=BillDetail::where('id_bill',$id)->get();
        
    
        $bill = Bill::find($id);
        $product=Product::all();
        
        

       
        return view('admin.bills.detail', compact('billDetail','bill','product'));
    }


    public function postDetail(Request $req,$id)
    {
        $bill = Bill::find($id);
      
        $bill->tinhtrang=$req->tinhtrang;
            $bill->save();
        return redirect('admin/bills/detail/'.$id)->with('thongbao','Sửa thành công');
    }
}