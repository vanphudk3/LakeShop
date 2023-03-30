<footer>
        <div class="footer-wrapper">
            <div class="footer-area footer-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer-menu d-flex justify-content-between flex-wrap">
                                <div class="logo">
                                    <a href="index.html"><img src="{{asset('images/logo.webp')}}" alt=""></a>
                                </div>
                                <nav>
                                    <ul>
                                        <li><a href="{{ route('home') }}">Trang Chủ</a></li>
                                        <li><a href="{{ route('product') }}">Sản Phẩm</a></li>
                                        <li><a href="">Câu Chuyện</a></li>
                                        <li><a href="{{route('about')}}">Về</a></li>
                                        <li>
                                            <a class="nav-link notification-footer" href="{{route('cart')}}">
                                                <i class="fas fa-shopping-cart"></i>
                                                <span class="badge">{{ Cart::count() }}</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-between" style="padding-bottom: 50px;">
                        <div class="col-xl-6 col-lg-6 col-md-10">
                            <div class="single-footer-caption mb-50">
                                <div class="single-footer-caption mb-50">
                                    <div class="footer-tittle">
                                        <div class="footer-pera">
                                            <p>Consectetur adipiscing elit, sed do eiusmod tempor dunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
                                                quis nostrud exercita tion ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                        </div>
                                    </div>
                                    <div class="social mt-50">
                                        <a href="" class="btn-02 btn-bttm">
                                            <i class="fa-brands fa-instagram"></i>
                                            Intasgram
                                        </a>
                                        <a href="" class="btn-02 btn-bttm" style="margin: 0 15px;">
                                            <i class="fa-brands fa-instagram"></i>
                                            Intasgram
                                        </a>
                                        <a href="" class="btn-02 btn-bttm">
                                            <i class="fa-brands fa-instagram"></i>
                                            Intasgram
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <i class="fa-solid fa-location-arrow" style="font-size: x-large;"></i>
                                    <h4>Location</h4>
                                    <ul style="padding: 0;">
                                        <li>4736 Poe Lane, HOT SPRINGS, Montana-59845</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <i class="fa-solid fa-phone" style="font-size: x-large;"></i>
                                    <h4>Location</h4>
                                    <ul style="padding: 0;">
                                        <li style="color:aliceblue;">913-473-7000</li>
                                        <li><b>contact@abc.com</b></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom-area">
                <div class="container">
                    <div class="row justify-content-center" style="border-top: 1px solid rgba(255,255,255,.2);">
                        <div class="col-xl-10">
                            <div class="footer-copy-right text-center">
                                <p>© 2020 <a href="https://colorlib.com" target="_blank">Colorlib</a> All rights reserved | This template is made with <i class="fa-solid fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>