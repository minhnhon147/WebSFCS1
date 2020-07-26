@extends('admin.trangchu')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Product
                <small>Edit</small>
            </h1>
        </div>
        <!-- /.col-lg-12 -->
        <div class="col-lg-7" style="padding-bottom:120px">
            @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $err){{$err}}<br>
                        @endforeach      
                    </div>
                @endif

            @if(session('thongbao'))
            <div class="alert alert-success">
                {{session('thongbao')}}
            </div>
            @endif
            <form action="admin/products/edit/{{$product->id}}" method="POST"  enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                
                <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" name="name" value="{{$product->name}}"  />
                </div>
                <div class="form-group">
                    <label>Type</label>
                    <select class="form-control" name="id_type" id="" >
                        @foreach ($product_type as $pt)
                            <option value={{$pt->id}}>{{$pt->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Price</label>
                    <input class="form-control" name="unit_price" value="{{$product->unit_price}}"  />
                </div>
                <div class="form-group">
                    <label>Hidden/Display</label>
                    <select class="form-control" name="new" id="">
                        
                            <option value="1">Display</option>
                            <option value="0">Hidden</option>
                        
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Images</label>
                    <input type="file" name="image">
                </div>
        
                <div class="form-group">
                    <label>Product Description</label>
                    <textarea class="form-control" rows="3" name="description"></textarea>
                </div>
                
                <button type="submit" class="btn btn-default">Product Edit</button>
                <button type="reset" class="btn btn-default">Reset</button>
            <form>
        </div>
    </div>
    <!-- /.row -->
</div>
@endsection