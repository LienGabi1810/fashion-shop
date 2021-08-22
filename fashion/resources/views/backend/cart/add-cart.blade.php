@extends('backend/master/master')
@section('title','Lien Fashion')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Đơn hàng</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Đơn hàng</a></li>
                <li class="breadcrumb-item active">Thêm đơn hàng</li>
            </ol>
            <div class="container">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Tên khách hàng</label>
                        <input type="name" name="name_customer" class="form-control">
                        {{-- gọi hàm showerros --}}
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="text" name="phone" class="form-control">
                        {{-- {{showErrors($errors,'name')}} --}}
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input type="number" name="address" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Tên sản phẩm</label>
                        <input type="text" name="name_product" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Số lượng</label>
                        <input type="text" name="quantity" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Tổng tiền</label>
                        <input type="number" name="total" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Tình trạng</label>
                        <select name="status" class="form-control">
                            <option value='1' selected>Chưa xử lý</option>
                            <option value='2'>Đã xử lý</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tình trạng vận chuyển</label>
                        <select name="status_transport" class="form-control">
                            <option value='1' selected>Đang chờ</option>
                            <option value='2'>Đang vận chuyển</option>
                            <option value='3'>Thành công</option>
                            <option value='4'>Thất bại</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Chi tiết đơn hàng</label>
                        <textarea name="info" style="width: 100%;height: 100px;"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Ghi chú</label>
                        <textarea name="note" style="width: 100%;height: 100px;"></textarea>
                    </div>
                </div>
                 <div class="col-md-12" style="margin-top: 20px">
                    <div class="form-group">
                        <button class="btn btn-success" name="add-product" type="submit">Lên đơn</button>
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