<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css/header-footer.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css "/>
    <link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css">
    <link rel="stylesheet" href="{{asset('css/swiper-bundle.min.css')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/favicon.webp')}}">
    <title>404 - Không tìm thấy trang</title>
</head>
<body class="body-bg">
    {{-- @include('layout.header') --}}
    <div class="error">
        <div class="container">
          <div class="error-content">
            <h1>404</h1>
            <h2 style="color: azure">Oops! Page Not Found!</h2>
      
            <div class="button" style="margin-top: 50px">
              <a href="{{route('home')}}" class="btn">Back to Home</a>
            </div>
          </div>
        </div>
      </div>      
    {{-- @include('layout.footer') --}}
</body>
<style>
    .error{
position: relative;

 width: 100%;
 height: 650px;
}
.error .error-content{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translateY(-50%)  translateX(-50%);

 
  

}
.error .error-content h1{
  text-align: center;
  color: #e5bf4a;
  font-size: 6rem;
  font-weight: 900;

}
.error .error-content .button{
  background-color: #e5bf4a;
  text-align: center;
}
.error .container .error-content{

}
</style>