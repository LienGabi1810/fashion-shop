@extends('backend/master/master')
@section('title','Lien Fashion')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <form method="POST" action="/admin/user/edit/{{$user->id}}">
            @csrf
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tài khoản</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Tài khoản</a></li>
                <li class="breadcrumb-item active">Chỉnh sửa tài khoản</li>
            </ol>
            <div class="container">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Tên</label>
                        <input type="text" name="name" class="form-control" value="{{$user->name}}">
                        {{showErrors($errors,'name')}}
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="number" name="phone" class="form-control" value="{{$user->phone}}">
                        {{showErrors($errors,'phone')}}
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input type="text" name="address" class="form-control" value="{{$user->address}}">
                        {{showErrors($errors,'address')}}
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" value="{{$user->email}}">
                        {{showErrors($errors,'email')}}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input type="text" name="password" class="form-control" value="{{$user->password}}">
                        {{showErrors($errors,'password')}}
                    </div>
                    <div class="form-group">
                        <label>Giới tính</label>
                        <select name="gender" class="form-control">
                            <option @if ($user->gender == 1) selected @endif value="1">Nam</option>
                            <option @if ($user->gender == 0) selected @endif value="0">Nữ</option>
                        </select>
                        {{showErrors($errors,'gender')}}
                    </div>
                    <div  class="form-group">
                        <label>Quyền</label>
                        <select name="role" class="form-control">
                            <option @if ($user->role == 1) selected @endif value="1">Admin</option>
                            <option @if ($user->role == 0) selected @endif value="0">Manager</option>
                        </select>
                        {{showErrors($errors,'role')}}
                    </div>
                </div>
                <div class="col-md-12" style="margin-top: 20px">
                    <div class="form-group">
                        <button class="btn btn-success" name="add-product" type="submit">Sửa tài khoản</button>
                        <button class="btn btn-danger" type="reset">Huỷ bỏ</button>
                    </div>
                 </div>
                </div>
              </div>
            </div>
        <div class="clearfix"></div>
        </form>
        </div>
    </main>
</div>
@endsection
@section('script')
@parent
<script>
        imgInp.onchange = evt => {
    const [file] = imgInp.files
    if (file) {
        blah.src = URL.createObjectURL(file)
    }
    }
    </script>
@endsection