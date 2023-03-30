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
    @extends('layout.pages')
    <title>{{$title}}</title>
</head>
<body class="body-bg" style="color: #ddd">
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa-solid fa-angles-up"></i></button>
    @include('layout.header')
    <main style="margin-top: 54px;">
        <div class="single-slider single-height d-flex justify-items-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-12">
                        <div class="hero-caption hero-caption2">
                            <h2>About Us</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section style="padding-bottom: 50px">
            <div class="container" style="padding-top: 50px">
                <div class="row justify-content-center">
                    <div class="col-xl-16 col-xl-7 col-md-9">
                        <div class="section-tittle text-center line mb-70">
                            <h4>This is Schilers. Awesome Food Theme. <br>
                                Purchase it and eat Burgers.</h4>
                                <hr>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center section-overlay">
                    <div class="offser-x1-1 offser-x1-2 col-xxl-5 col-xxl-6 col-xl-6 col-lg-6 col-md-9">
                        <h5>This is Schilers. Awesome Food Theme.
                            <br> Purchase it and eat Burgers.</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor dunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercita tion ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute dolor in reprehen derit in voluptate velit esse cillum.</p>
                        <p>Consectetur adipiscing elit, sed do eiusmod tempor dunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercita tion ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute dolor in reprehen derit in voluptate velit esse cillum.</p>
                    </div>
                    <div class="col-xxl-5 col-xl-5 col-lg-6 col-md-8"><img src="images/home/cookie-big.webp" alt="" ></div>
                </div>
            </div>
        </section>
        <section class="cta-area bg-overlay bg-img" style="background-image: url(https://cdn.thongtinduan.com/uploads/posts/2020-05/thiet-ke-can-bep-trong-mo-cho-nhung-nguoi-dam-me-lam-banh-1.jpg);">
            <div class="containerss h-100">
                <div class="rows h-100 align-items-center">
                  <div class="col-13 container">
                    <div class="text-center">
                        <h2>Gluten Free Receipies</h2>
                        <p>Fusce nec ante vitae lacus aliquet vulputate. Donec scelerisque accumsan molestie. 
                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Cras sed accumsan neque. Ut vulputate, lectus vel aliquam congue, risus leo elementum nibh</p>
                        <a href="#" class="btn_1 hero-btn" data-animation="fadeInUp" data-delay=".8s">Discover all the receipies</a>
                    </div>
                  </div>
                </div>
              </div>
        </section>
        <section style="padding: 50px  0">
            <div class="container col-xl-1">
                <div class="row justify-content-center" style="padding-bottom: 40px;">
                    <div class="col-xl-6 col-lg-7 col-md-7">
                        <div class="section-title text-center mb-50" style="color: #9b9494">
                            <h2>Food Love's Say</h2>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row-r">
                        <div class="column">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <p>
                                "Consectetur adipiscing elit, 
                            sed do eiusmod tempor dunt ulter labore et dolore magna."
                            </p>
                            <p><i class="fa-solid fa-user"></i> Wilma Mumduya</p>
                        </div>
                        <div class="column">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <p>
                                "Consectetur adipiscing elit, 
                            sed do eiusmod tempor dunt ulter labore et dolore magna."
                            </p>
                            <p><i class="fa-solid fa-user"></i> Wilma Mumduya</p>
                        </div>
                        <div class="column">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <p>
                                "Consectetur adipiscing elit, 
                            sed do eiusmod tempor dunt ulter labore et dolore magna."
                            </p>
                            <p><i class="fa-solid fa-user"></i> Wilma Mumduya</p>
                            
                        </div>
                      </div>
                  </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="section-tittle text-center mb-90 d-flex justify-content-between flex-wrap align-items-center">
                            <h2>Our Blogs</h2>
                            <a href="#" class="btn_1 hero-btn" data-animation="fadeInUp" data-delay=".8s">MORE BLOG</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="div1">
                <img class="img2" src="images/home/blog-1.webp" alt="Pineapple" width="350" height="300">
                <div class="clearfix div2 other">
                  
                  <h2>Tomato, black olive, feta & anchovy tart ulla mco laboris</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor dunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
                    quis nostrud exercita tion ullamco laboris nisi ut aliquip.</p>
                    <a href="">LEARN MORE</a>
                </div>
                <img class="img2" src="images/home/blog-2.webp" alt="Pineapple" width="350" height="300">
                <div class="clearfix div2 other">
                  
                  <h2>Tomato, black olive, feta & anchovy tart ulla mco laboris</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor dunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
                    quis nostrud exercita tion ullamco laboris nisi ut aliquip.</p>
                    <a href="">LEARN MORE</a>
                </div>
              </div>
        </section>
        <div class="instagram">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-7 col-md-7">
                        <div class="section-tittle text-center mb-70">
                            <h2>Follow us on Instagram</h2>
                            <a href="" class="btn-02 btn-02s mt-25">
                                <i class="fa-brands fa-instagram"></i>
                                Cakeshop
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="row-bttm" style="padding-top: 50px;">
                    <div class="column-bttm">
                      <img src="{{asset('images/home/instagram-1.webp')}}" style="width:100%"  class="hover-shadow cursor">
                    </div>
                    <div class="column-bttm">
                      <img src="{{asset('images/home/instagram-2.webp')}}" style="width:100%" class="hover-shadow cursor">
                    </div>
                    <div class="column-bttm">
                      <img src="{{asset('images/home/instagram-3.webp')}}" style="width:100%" class="hover-shadow cursor">
                    </div>
                    <div class="column-bttm">
                      <img src="{{asset('images/home/instagram-4.webp')}}" style="width:100%" class="hover-shadow cursor">
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('layout.footer')
</body>
</html>