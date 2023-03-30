<header>
        <div class="header-area">
            <div class="main-header">
                <div class="header-top">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="d-flex justify-content-between flex-wrap align-items-center">
                                    <div class="detail-link d-none d-sm-block">
                                        <ul class="link-ld">
                                            <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa-brands fa-instagram"></a></i></li>
                                            <li><a href="#"><i class="fa-brands fa-twitter"></a></i></li>
                                        </ul>
                                    </div>
                                    <div class="main-header">
                                        <a href="{{ route('home') }}"><img src="{{asset('images/logo.webp')}}" alt=""></a>
                                    </div>
                                    <div class="call-header d-none d-lg-block"><a href="#" class="btn-contracts">Call us: 058 789 456</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="justifile">
                    <ul class="nav justify-content-center">
                    @if (session('id'))
                        <li class="nav-item" style="border-right: 2px solid #e5bf4a;">
                            <a href="#" class="nav-link disabled"><i class="fa fa-user" aria-hidden="true" style="font-size: 14px; padding-right: 10px;"></i>{{ session('name') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('logout')}}"><i class="fa fa-sign-out" aria-hidden="true" style="font-size: 14px; padding-right: 5px;"></i>Logout</a>
                        </li>
                    @else
                        <li class="nav-item" style="border-right: 2px solid #e5bf4a;"><a href="{{route('login')}}">ĐĂNG NHẬP</a></li>
                        <li class="nav-item"><a href="{{route('register')}}">ĐĂNG KÝ</a></li>
                    @endif
                    </ul>
                </div>
                <div class="nav-menu">
                    <div class="topnav" id="myTopnav">
                        <div class="text-center">
                            <a href="{{route('home')}}" class="nav-link" >Trang Chủ</a>
                            <a href="{{route('product')}}" class="nav-link" >Sản Phẩm</a>
                            <a href="#contact" class="nav-link" >Câu Truyện</a>
                            <a href="{{route('about')}}" class="nav-link" >Về</a>
                            <a class="nav-link notification" href="{{route('cart')}}">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="badge" id="count">
                                    <?php 
                                        $content = Cart::content();
                                        echo count($content);
                                    //Cart::count() > 0 ? print_r(Cart::count()) : print_r(0);
                                    ?>
                                </span>
                            </a>
                            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                                <i class="fa fa-bars"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</header>
{{-- @extends('layout.pages') --}}