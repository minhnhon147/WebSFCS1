@extends('admin.trangchu')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Bill
                <small>Detail</small>
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
            <form action="admin/bills/detail/{{$bill->id}}" method="POST"  enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                
                <div class="form-group">
                    <label>Customer Name</label>
                    <li class="form-control" name="name" value="{{$bill->customer->name}}"  > {{$bill->customer->name}}</li>
                </div>
                <div class="form-group">
                    <label>Sản phẩm đã đặt</label>
                    @foreach ($billDetail as $bd)
                    <li class="form-control" name="bill" id="" >                          
                        
                        {{$bd['product']['name']}}    {{$bd->quantity}}
                        
                                   
                    </li>
                    @endforeach
                </div>

                <label>Description</label>
                <li class="form-control" name="name" value=""  > {{$bill->note}}</li>

                <div class="form-group">
                    <label>Tình trạng đơn hàng</label>
                    <select class="form-control" name="tinhtrang" id="">
                        
                        <option value="0">Chưa xử lí</option>
                        <option value="1">Đang xử lí</option>
                        <option value="2">Đã xử lí</option>
                    
                </select>
                </div>



                <button type="submit" class="btn btn-default">Product Edit</button>

                



                

                
                
            <form>
        </div>
    </div>
    <!-- /.row -->
</div>
@endsection