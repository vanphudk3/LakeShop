<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/header-footer.css')}}">
    <title>{{$title}}</title>
</head>
<body>
    <h1>{{$name}}</h1>
    <h4>{{$body}}</h4>
    <p>
        Chúc mừng bạn đã kích hoạt tài khoản khách hàng thành công. 
    </p>
    <p>
        Lần mua hàng tiếp theo, hãy đăng nhập để việc thanh toán thuận tiện hơn.
    </p>
    <button style="padding: 15px,
                border:none,
                background-color: #e5bf4a">
        <a href="http://127.0.0.1:8000/" style="text-decoration: none">Đến với cửa hàng của chúng tôi</a>
    </button>
</body>
</html>