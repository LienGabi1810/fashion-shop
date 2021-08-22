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
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Category List
                </div>
                <div style="display: flex">
                    <div class="col-md-5" style="padding-right: 100px">
                        <form method="post">
                            @csrf
                        <div>
                            <div style="margin-bottom: 20px" class="form-group">
                                <label style="margin-bottom: 10px" for="">Danh mục cha:</label>
                                <select class="form-control" name="parent" id="">
                                    <option>----ROOT----</option>
                                    <option>Nam</option>
                                    <option>---|Áo khoác nam</option>
                                    <option>---|---|Áo khoác nam</option>
                                    <option>Nữ</option>
                                    <option>---|Áo khoác nữ</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label style="padding-bottom: 20px" for="">Tên Danh mục</label>
                                <input type="text" class="form-control" name="name" id="" placeholder="Tên danh mục mới">
                                {{-- {{showErrors($errors,'name')}} --}}
                                {{-- <div class="alert bg-danger" role="alert">
                                    <svg class="glyph stroked cancel">
                                        <use xlink:href="#stroked-cancel"></use>
                                    </svg>Tên danh mục đã tồn tại!<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                                </div> --}}
                            </div>
                            <button style="margin-top: 20px" type="submit" class="btn btn-primary">Thêm danh mục</button>
                        </div>
                        </form>
                    </div>
                    <div class="col-md-7" style="padding-left: 150px">
                        <div>
                            {{-- <div class="alert bg-success" role="alert">
                                <svg class="glyph stroked checkmark">
                                    <use xlink:href="#stroked-checkmark"></use>
                                </svg> Đã thêm danh mục thành công! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                            </div> --}}
                            <h3 style="margin: 0;"><strong>Phân cấp Menu</strong></h3>
                            <div class="vertical-menu">
                                <div class="item-menu active">Danh mục </div>
                                <div class="item-menu"><span>Nam</span>
                                    <div class="category-fix">
                                        <a class="btn-category btn-primary" href="editcategory.html"><i class="fa fa-edit"></i></a>
                                        <a class="btn-category btn-danger" href="#"><i class="fas fa-times"></i></i></a>
        
                                    </div>
                                </div>
                                <div class="item-menu"><span>---|Áo khoác Nam</span>
                                    <div class="category-fix">
                                        <a class="btn-category btn-primary" href="editcategory.html"><i class="fa fa-edit"></i></a>
                                        <a class="btn-category btn-danger" href="#"><i class="fas fa-times"></i></i></a>
        
                                    </div>
                                </div>
                                <div class="item-menu"><span>---|---|Áo khoác Nam (Dành cho việc mở rộng)</span>
                                    <div class="category-fix">
                                        <a class="btn-category btn-primary" href="editcategory.html"><i class="fa fa-edit"></i></a>
                                        <a class="btn-category btn-danger" href="#"><i class="fas fa-times"></i></i></a>
        
                                    </div>
                                </div>
                                <div class="item-menu"><span>Nữ</span>
                                    <div class="category-fix">
                                        <a class="btn-category btn-primary" href="editcategory.html"><i class="fa fa-edit"></i></a>
                                        <a class="btn-category btn-danger" href="#"><i class="fas fa-times"></i></i></a>
        
                                    </div>
                                </div>
                                <div class="item-menu"><span>---|Áo khoác Nữ</span>
                                    <div class="category-fix">
                                        <a class="btn-category btn-primary" href="editcategory.html"><i class="fa fa-edit"></i></a>
                                        <a class="btn-category btn-danger" href="#"><i class="fas fa-times"></i></i></a>
        
                                    </div>
                                </div>
                            </div>
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