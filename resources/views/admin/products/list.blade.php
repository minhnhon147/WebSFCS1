@extends('admin.trangchu')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Product
                <small>List</small>
            </h1>
        </div>
        @if(session('thongbao'))
        <div class="alert alert-success">
            {{session('thongbao')}}
        </div>
        @endif
        <!-- /.col-lg-12 -->
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr align="center">
                    <th>ID</th>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Hidden/Display</th>
                    <th>Delete</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($product as $p)
                <tr class="odd gradeX" align="center">
                    <td>{{$p->id}}</td>
                    <td>{{$p->product_type->name}}</td>
                    <td>{{$p->name}}</td>
                    <td>{{$p->unit_price}}</td>
                    <td>3 Minutes Age</td>
                    <td>{{$p->description}}</td>
                    <td>{{$p->image}}</td>
                    @if($p->new == 1)
                        <td>Display</td>
                    @else
                        <td>Hidden</td>
                    @endif
                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/products/delete/{{$p->id}}"> Delete</a></>
                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/products/edit/{{$p->id}}">Edit</a></td>
                </tr>
                @endforeach
                            
            </tbody>
        </table>
    </div>
    <!-- /.row -->
</div>

@endsection
       