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
                    <th>ID Bills</th>
                    <th>State</th>
                    <th>Name</th>
                    <th>Date Order</th>
                    <th>Total Price</th>
                    <th>Payment</th>
                    <th>Description</th>
                    {{--  <th>Image</th>
                    <th>Hidden/Display</th>  --}}
                   
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bills as $p)
                <tr class="odd gradeX" align="center">
                    <td>{{$p->id}}</td>
                    @if($p->tinhtrang == 0)
                    <td>Chưa xử lí</td>
                    @else
                    @if ($p->tinhtrang==1)
                    <td>Đang xử lí</td>    
                    @else
                    <td>Đã xử lí</td>
                    @endif
                    @endif
                    <td>{{$p->customer->name}}</td>
                    <td>{{$p->date_order}}</td>
                    <td>{{$p->total}}</td>
                    
                    <td>{{$p->payment}}</>
                    <td>{{$p->note}}</td>
                    
                   
                    <td class="center"><i class="fa fa-bars fa-fw"></i> <a href="admin/bills/detail/{{$p->id}}">Details</a></td>
                </tr>
                @endforeach
                            
            </tbody>
        </table>
    </div>
    <!-- /.row -->
</div>

@endsection
       