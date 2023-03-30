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
    <title>Document</title>
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
        <div class="content-cart">
            <div class="container">
                <div class="row justify-content-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="{{ route('home')  }}" style="text-decoration: none; color: #6c757d">Home</a></li>
                          <li class="breadcrumb-item"><a href="{{ route('product')  }}" style="text-decoration: none; color: #6c757d;">Product</a></li>
                          <li class="breadcrumb-item active" aria-current="page" style="color: aliceblue;">{{$product->name}}</li>
                        </ol>
                    </nav>
                    <hr>
                </div>
            </div>
            <div class="container content-area">
                <div class="row justify-content-center delicious-slides-1">
                    <img src="{{asset('images/home/'  . $product->image)}}" alt="" height="400">
                </div>
                <div class="row justify-content-center delicious-slides-2">

                        <div class="card-content" style="padding: 10px 20px;">
                            <h2>{{$product->name}}</h2>
                            <p>Kho: {{$product->quantity}}</p>
                            <div class="content-evaluate">
                                <span class="fa fa-star checked" style="float: none;font-weight: 600;"></span>
                                <b></b> (12 danh gia)
                                Da dat ...
                            </div>
                            <form action="{{  route('save-cart')  }}" method="post" id="frmcart">
                                @csrf
                                <input type="hidden" name="product_id_hidden" id="product_id_hidden" value="{{ $product->id }}">
                                <input type="hidden" name="product_rowId_hidden" id="product_rowId_hidden" value="{{ $product->rowId }}">
                                <input type="hidden"  value="{{$product->price}}" class="cart_product_price_{{$product->id}}">
                                <input type="hidden"  value="{{$product->image}}" class="cart_product_price_{{$product->id}}">
                                <input type="hidden"  value="{{$product->quantity}}" id="warehouse">
                                <!-- <input type="hidden"  value="{{$product->quantity}}" class="cart_product_qty_{{$product->id}}"> -->
                                
                                <bdi>{{number_format($product->price)}} vnd</bdi>
                                <div class="content-sl">
                                    <div>Số lượng: </div>
                                    <div class="input-group" style="margin-left: 8px;padding: 0;">
                                        <div class="input-group-prepend" style="padding-right: 0px;">
                                            <button class="btn btn-outline-secondary" style="z-index: 0" type="button"  onclick="var result = document.getElementById('sst'); 
                                            var sst = result.value; 
                                            if( !isNaN( sst ) && sst > 1 ) 
                                                result.value--;
                                            return false;">-</button>
                                        </div>
                                        <input type="Number" name="qty" style="padding: 14px 0px;" class="form-control cart_product_qty_{{$product->id}}" placeholder="" aria-label="Example text with button addon" id="sst" aria-describedby="button-addon1" aria-valuenow="1" value="1" title="Quantity:">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" style="z-index: 0" type="button" id="button-addon2" onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-sl">
                                    <div>Size Bánh: </div>
                                    <div class="input-group">
                                        <select class="form-select cart_product_size_{{$product->id}}" name="ssz" aria-label="Default select example" style="width: 100%; height: 100%; padding: 0 27px 0 0;">
                                            <!-- <option selected value="-1">Chọn size</option> -->
                                            @foreach($size as $sizes)
                                                <option value="{{  $sizes->id   }}" accesskey="szs" id="size">{{  $sizes->size  }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if (session('status'))
                                    <div class="" style="color: red;">
                                        <i>* {{ session('status') }}</i>
                                    </div>
                                @endif
                                <button class="btn warning" id="Btnproduct" type="submit" style="width: 100%;" data-id_product="{{ $product->id }}">Thêm vào giỏ</button>
                                <hr>
                                <div class="content-detail">
                                    <button type="button" class="collapsible">Miêu tả</button>
                                    <div class="content">
                                    <p>{{$product->description}}</p>
                                    <hr>
                                    </div>
                                    <button type="button" class="collapsible">Có gì đặt biệt</button>
                                    <div class="content">
                                    <p>{{$product->special}}</p>
                                    <hr>
                                    </div>
                                    <button type="button" class="collapsible">Bảo quản</button>
                                    <div class="content">
                                    <p>{{$product->preserve}}</p>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <hr>
                    <div class="" style="padding-bottom: 40px;">
                        <div class="">
                            <div class="section-title text-center" style="color: #9b9494; padding-top: 10px;">
                                <h6>ĐÁNH GIÁ SẢN PHẨM</h6>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="content-comment">
                        <div class="content-comment-1">
                            <div class="content-comment-1-1">
                                <p><i class="fa-solid fa-user"></i> Wilma Mumduya</p>
                            </div>
                            <div class="content-comment-1-2">
                                <div class="content-comment-1-2-1">
                                    <div class="content-comment-1-2-1-1">
                                        <h6>Nguyễn Văn A</h6>
                                        <span class="fa fa-star checked" style="float: none;font-weight: 600;"></span>
                                        <span class="fa fa-star checked" style="float: none;font-weight: 600;"></span>
                                        <span class="fa fa-star checked" style="float: none;font-weight: 600;"></span>
                                        <span class="fa fa-star checked" style="float: none;font-weight: 600;"></span>
                                        <span class="fa fa-star checked" style="float: none;font-weight: 600;"></span>
                                    </div>
                                    <div class="content-comment-1-2-1-2">
                                        <p>Đã đặt 2 lần, rất ngon, đóng gói cẩn thận, giao hàng nhanh, nhân viên tư vấn nhiệt tình, tôi sẽ đặt tiếp.</p>
                                    </div>
                                </div>
                                <div class="content-comment-1-2-2">
                                    <p>Ngày 12/12/2020</p>
                                </div>
                            </div>
                        </div>
                        <div class="content-comment-1">
                            <div class="content-comment-1-1">
                                <p><i class="fa-solid fa-user"></i> Wilma Mumdu</p>
                            </div>
                            <div class="content-comment-1-2">
                                <div class="content-comment-1-2-1">
                                    <div class="content-comment-1-2-1-1">
                                        <h6>Nguyễn Văn A</h6>
                                        <span class="fa fa-star checked" style="float: none;font-weight: 600;"></span>
                                        <span class="fa fa-star checked" style="float: none;font-weight: 600;"></span>
                                        <span class="fa fa-star checked" style="float: none;font-weight: 600;"></span>
                                        <span class="fa fa-star checked" style="float: none;font-weight: 600;"></span>
                                        <span class="fa fa-star checked" style="float: none;font-weight: 600;"></span>
                                    </div>
                                    <div class="content-comment-1-2-1-2">
                                        <p>Đã đặt 2 lần, rất ngon, đóng gói cẩn thận, giao hàng nhanh, nhân viên tư vấn nhiệt tình, tôi sẽ đặt tiếp. 
                                            Đã đặt 2 lần, rất ngon, đóng gói cẩn thận, giao hàng nhanh, nhân viên tư vấn nhiệt tình, tôi sẽ đặt tiếp.
                                        </p>
                                    </div>
                                </div>
                                <div class="content-comment-1-2-2">
                                    <p>Ngày 12/12/2020</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="" style="padding-bottom: 40px;">
                <div class="">
                    <div class="section-title text-center" style="color: #9b9494; padding-top: 10px;">
                        <h6>CÓ THỂ BẠN SẼ THÍCH</h6>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="container" style="padding-bottom: 70px">
                <div class="slide-container swiper" style="padding-bottom: 25px;">
                    <div class="slide-content">
                        <div class="card-wrapper swiper-wrapper">
                            @foreach($pt as $each)
                            <div class="card swiper-slide">
                                <div class="image-content">
                                    <span class="overlay"></span>
                                    <div class="card-image containers">
                                        <img src="{{asset('images/home/'  . $each->image)}}" alt="" class="card-img image"/>
                                        <div class="middle">
                                            <div class="text">
                                                <a href="{{ route('product-detail', $each) }}">View Detail</a> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-content">
                                        <a href="{{ route('product-detail',$each)}}" style="text-decoration: none; color: #e5bf4a">
                                            <h2>{{ $each->name }}</h2>
                                            <span>{{  $each->price  }} vnd</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
        
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
                <div class="section-title text-center" style="color: #9b9494">
                    <a href="#" class="btn-contracts">Xem tất cả</a>
                </div>

            </div>
        </div>
    </main>
    @include('layout.footer')
</body>

</html>