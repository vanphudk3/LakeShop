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
    <link rel="stylesheet" href="{{asset('css/swiper-bundle.min.css')}}">
    
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.webp">
    <title>Document</title>
</head>
<body class="body-bg">
    @include('layout.header')
    <main>
        <div class="form-total">
            <div class="form-area">
                <div class="form-content">
                    <form action="{{route('process-login')}}" method="post">
                    @csrf
                        <div class="container-register">
                            <h1>Login Now</h1>
                            <p>You can login using your social media account or email
                                address.</p>
                        @if ($errors->any())
                            <div class="alert alert-danger" style="padding: 5px;">
                                <ul style="list-style: none; width: 95%; padding-top: 10px;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('status'))
                            <div class="alert alert-danger">
                                {{ session('status') }}
                            </div>
                        @endif
                            <hr>
                            <input type="text" placeholder="Enter Email" name="email" id="email" required style="background-color: #f2f2f2; color: black;">
                            <input type="password" placeholder="Enter Password" name="password" id="psw" required style="background-color: #f2f2f2; color: black;">
                            <label style="display: -webkit-box;">
                                <input type="checkbox" name="remember" style="margin-bottom:15px"> Remember me              
                            </label>
                            <hr>
                            <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
                            <button type="submit" class="registerbtn">Login</button>
                        </div>
                        <div class="container-register signin">
                          <p>You haven't account? <a href="#">Register</a>.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    @include('layout.footer')
</body>
</html>