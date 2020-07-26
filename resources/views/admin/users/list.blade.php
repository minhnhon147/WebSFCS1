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
                    <th>ID Users</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Edit</th>
                    
                    {{--  <th>Image</th>
                    <th>Hidden/Display</th>  --}}
                   
                    
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr class="odd gradeX" align="center">
                    <td>{{$u->id}}</td>
                    <td>{{$u->full_name}}</td>
                    <td>{{$u->email}}</td>
                    <td>{{$u->password}}</td>
                    <td>{{$u->phone}}</td>
                    
                    <td>{{$u->address}}</>
                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/users/edit/{{$u->id}}">Edit</a></td>
                    
                    
                   
                    
                </tr>
                @endforeach
                            
            </tbody>
        </table>
    </div>
    <!-- /.row -->
</div>

@endsection
       