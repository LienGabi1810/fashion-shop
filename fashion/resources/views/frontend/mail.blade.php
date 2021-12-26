<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>{{$shop}}</h1>
    <p>Chúng tôi gửi đơn hàng cho quý khách vừa đặt tại Lien Fashion Shop. Qúy khách vui lòng để ý điện thoại để nhân viên của chúng tôi có thể liên hệ!</p>
      <table class="table table-bordered table-dark">
        <thead>
          <tr>
            <th scope="col">Tên khách hàng:</th>
            <th scope="col">Địa chỉ</th>
            <th scope="col">Số điện thoại</th>
            <th scope="col">Sản phẩm</th>
            <th scope="col">Tổng tiền</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">{{$name}}</th>
            <td>{{$address}}</td>
            <td>{{$phone}}</td>
            <td>{{$info}}</td>
            <td>{{$tongtien}}</td>
          </tr>
        </tbody>
      </table>
</body>
</html>