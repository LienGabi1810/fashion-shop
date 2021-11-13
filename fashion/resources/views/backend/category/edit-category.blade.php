@extends('backend/master/master')
@section('title','Lien Fashion')
@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Category</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Lien Fashion</a></li>
                <li class="breadcrumb-item active">Category</li>
            </ol>
            @if (session('thongbao'))
            <div class="alert bg-success" role="alert">
                {{session('thongbao')}} <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
            </div>
            @endif
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Category Edit
                </div>
                <div style="display: flex">
                    <div class="col-md-5" style="padding-right: 100px">
                        <form method="post" action="/admin/category/category-edit">
                            @csrf
                        <div>
                            <input type="hidden" name="category_id" value="{{$cate->id}}">
                            <div style="margin-bottom: 20px" class="form-group">
                                <label for="">Danh mục cha:</label>
                                <select class="form-control" name="parent" id="">
                                    <option value="0">---ROOT---</option>
                                    {{getCategory($category,0,'',$cate->parent_id)}}
                                </select>
                            </div>
                            <div class="form-group">
                                <label style="padding-bottom: 20px" for="">Tên Danh mục</label>
                                <input type="text" class="form-control" name="name" id="" placeholder="Tên danh mục mới" value="{{$cate->name}}">
                                {{showErrors($errors,'name')}}
                            </div>
                            <button style="margin-top: 20px" type="submit" class="btn btn-primary">Sửa danh mục</button>
                        </div>
                        </form>
                    </div>
                    <div class="col-md-7">
                        <h3 style="margin: 0;"><strong>Phân cấp Menu</strong></h3>
                        <div class="vertical-menu">
                            <div class="item-menu active">Danh mục </div>
                            {{showCategory($category,0,'')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Your Website 2021</div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</div>

@endsection
@section('script')
    @parent
    <script>
        function del(){
            return confirm('Bạn có muốn xóa danh mục này?')
        }
    </script>
@endsection