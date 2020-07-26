@extends('admin.trangchu')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">User
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
            <form action="admin/users/edit/{{$user->id}}" method="POST"  enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                
                <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" name="full_name" value="{{$user->full_name}}"  />
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" name="email" value="{{$user->email}}"  />
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" name="password" value="{{$user->password}}"  />
                </div>

                <div class="form-group">
                    <label>Phone number</label>
                    <input class="form-control" name="phone" value="{{$user->phone}}" type="number"  />
                </div>
                <div class="form-group">
                    <label>Address</Address></label>
                    <input class="form-control" name="address" value="{{$user->address}}"  />
                </div>
               
               
        
                
                
                <button type="submit" class="btn btn-default">User Edit</button>
                <button type="reset" class="btn btn-default">Reset</button>
            <form>
        </div>
    </div>
    <!-- /.row -->
</div>
@endsection