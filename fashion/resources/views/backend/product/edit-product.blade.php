@extends('backend/master/master')
@section('title','Lien Fashion')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Sản phẩm</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Sản phẩm</a></li>
                <li class="breadcrumb-item active">Chỉnh sửa sản phẩm</li>
            </ol>
            <form method="POST" enctype="multipart/form-data" action="/admin/product/edit/{{$product->id}}">
                @csrf
                <div class="container">
                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                        <label>Danh mục</label>
                        <select name="category_id" class="form-control">
                            <option value='1' selected>Nam</option>
                            <option value='3'>---|Áo khoác nam</option>
                            <option value='2'>Nữ</option>
                            <option value='4'>---|Áo khoác nữ</option>
                        </select>
                        {{showErrors($errors,'category_id')}}
                    </div>
                    <div class="form-group">
                        <label>Mã sản phẩm</label>
                        <input type="text" name="code" readonly class="form-control" value="{{$product->code}}">
                        {{showErrors($errors,'code')}}
                    </div>
                    <div class="form-group">
                        <label>Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control" value="{{$product->name}}">
                        {{showErrors($errors,'name')}}
                    </div>
                    <div class="form-group">
                        <label>Số lượng</label>
                        <input type="number" name="quantity" class="form-control" value="{{$product->quantity}}">
                        {{showErrors($errors,'quantity')}}
                    </div>
                    <div class="form-group">
                        <label>Giá sản phẩm (Giá chung)</label>
                        <input type="number" name="price" class="form-control" value="{{$product->price}}">
                        {{showErrors($errors,'price')}}
                    </div>
                    <div class="form-group">
                        <label>Sản phẩm có nổi bật</label>
                        <select name="is_hightlight" class="form-control" value="{{$product->is_hightlight}}">
                            <option value="0">Không</option>
                            <option value="1">Có</option>
                        </select>
                        {{showErrors($errors,'is_hightlight')}}
                    </div>
                    <div class="form-group">
                        <label>Trạng thái</label>
                        <select name="status" class="form-control" value="{{$product->status}}">
                            <option value="1">Còn hàng</option>
                            <option value="0">Hết hàng</option>
                        </select>
                        {{showErrors($errors,'status')}}
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                        <label>Ảnh sản phẩm</label>
                        {{-- <input id="img" type="file" name="img" class="form-control hidden"
                            onchange="changeImg(this)">
                        <img id="avatar" class="thumbnail" width="100%" height="350px" src=""> --}}
                        @if ($product->image)
                        <input name="image" accept="image/*" type='file' id="imgInp" class="form-control hidden" value="{{$product->image}}"/>
                        <input name="image" type="hidden" value="{{$product->image}}"/> 
                        @else
                        <input name="image" accept="image/*" type='file' id="imgInp" class="form-control hidden" value="{{$product->image}}"/>
                        @endif
                        <img id="blah" width="100%" height="350px" src="/uploads/products/{{$product->image}}"/>
                        {{showErrors($errors,'image')}}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Thông tin</label>
                        <textarea name="info" style="width: 100%;height: 100px;">{{$product->info}}</textarea>
                        {{showErrors($errors,'info')}}
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                        <label>Miêu tả</label>
                        <textarea id="editor" name="describe" style="width: 100%;height: 100px;">{{$product->describe}}</textarea>
                        {{showErrors($errors,'describe')}}
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                        <button class="btn btn-success" name="add-product" type="submit">Sửa sản phẩm</button>
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