<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductType;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function getList()
    {
        
        $product = Product::all();
        return view('admin.products.list',compact('product'));
    }
    
    public function getAdd()
    {
        $product_type = ProductType::all();
        return view('admin.products.add',compact('product_type'));
    }
    public function postProduct(Request $req)
    {
        $this->validate($req,
            [
                'name'=>'required|unique:products',
               
            ],
            [
               
                'name.unique'=>'Tên sản phẩm đã tồn tại',
               
            ]);
        $products = new Product;
        $products->name = $req->name;
        $products->id_type = $req->id_type;
        $products->description = $req->description;
        $products->unit_price=$req->unit_price;
        $products->promotion_price= 0;
        if($req->hasFile('image'))
       
        
        {
            $file = $req->file('image');    

            $name = $file->getClientOriginalName();
            $image = str::random(4)."_".$name;
            while(file_exists("source/image/product/".$image))
            {
                $image = str::random(4)."_".$name;
            }
            $file->move("source/image/product/",$image);
            $products->image = $image;
        }
        
        else
        {
           $products->image = "";   
        }
        $products->unit=$req->unit;
        $products->new=$req->new;
        $products->save();
        
        return redirect('admin/products/add')->with('thongbao','Thêm thành công');
    }
    
     public function getEdit($id)
    {
        $product = Product::find($id);
        $product_type = ProductType::all();
        return view('admin.products.edit', compact('product','product_type'));
    }

    public function postEdit(Request $req,$id)
    {
        $product = Product::find($id);
      
        $product->name = $req->name;
        $product->id_type = $req->id_type;
        $product->description = $req->description;
        $product->unit_price=$req->unit_price;
        $product->promotion_price= 0;
        if($req->hasFile('image'))
        {
            $file = $req->file('image');    
            $name = $file->getClientOriginalName();
            $image = str::random(4)."_".$name;
            while(file_exists("source/image/product/".$image))
            {
                $image = str::random(4)."_".$name;
            }
            $file->move("source/image/product/",$image);
            $product->image = $image;
        }
        else
        {
          
        }
        $product->unit=$req->unit;
        $product->new=$req->new;
            $product->save();
        return redirect('admin/products/edit/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getDelete($id)
    {

        $product = product::find($id);
        $product->delete();
        return redirect('admin/products/list')->with('thongbao','Xóa thành công');
    }

    
}
