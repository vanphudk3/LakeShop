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
<body class="body-bg">
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa-solid fa-angles-up"></i></button>
    @include('layout.header')
    <main style="margin-top: 54px;">
        <div class="single-slider single-height d-flex justify-items-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-12">
                        <div class="hero-caption hero-caption2">
                            <h2>Delicious Cakes</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section style="margin-top: 80px">
            <div class="container">
                <div class="row justify-content-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="{{ route('home')  }}" style="text-decoration: none; color: #6c757d">Home</a></li>
                          <li class="breadcrumb-item active" aria-current="page" style="color: aliceblue;">Product</li>
                        </ol>
                    </nav>
                    <hr>
                    <div class="row">
                        @foreach($product as $products)
                        <div class="column">
                            <div class="card-image containers">
                                <div class="notify">
                                    <img src="{{asset('images/home/'  . $products->image)}}" alt="" class="card-img image">
                                    @if($products->id > 6)
                                    <span class="product-new">New</span>
                                    @elseif($products->quantity == 0)
                                    <span class="product-new" style="background-color: #e5bf4a;">Sold out</span>
                                    @endif
                                </div>
                                <div class="middle">
                                    <div class="text">
                                        <a href="{{route('product-detail',$products)}}">View Detail</a> 
                                    </div>
                                </div>
                            </div>
                            <div class="card-content">
                                <a href="{{ route('product-detail',$products)}}">
                                    <h2>{{$products->name}}</h2>
                                    <span>{{number_format($products->price)}} VNĐ</span>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div style="display:block; margin-top: 5%; text-align: center;">
                        {{$product->links()}}
                    </div>
                </div>
                <hr>
            </div>
            
        </section>
        
        <div class="" style="padding-bottom: 40px;">
            <div class="">
                <div class="section-title text-center" style="color: #9b9494; padding-top: 5px;">
                    <h2>Follow us on Instagram</h2>
                </div>
            </div>
        </div>
        <div class="text-center" style="padding-bottom: 70px;">
            <a href="" class="btn-02 btn-02s mt-25 btn-01">
                <i class="fa-brands fa-instagram"></i>
                Cakeshop
            </a>
        </div>
        <div class="container">
            <div class="row justify-content-center content-area">
                <div class="row-bttm">
                    <div class="column-bttm">
                      <img src="images/home/instagram-1.webp" style="width:100%"  class="hover-shadow cursor">
                    </div>
                    <div class="column-bttm">
                      <img src="images/home/instagram-2.webp" style="width:100%" class="hover-shadow cursor">
                    </div>
                    <div class="column-bttm">
                      <img src="images/home/instagram-3.webp" style="width:100%" class="hover-shadow cursor">
                    </div>
                    <div class="column-bttm">
                      <img src="images/home/instagram-4.webp" style="width:100%" class="hover-shadow cursor">
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('layout.footer')
</body>

</html>