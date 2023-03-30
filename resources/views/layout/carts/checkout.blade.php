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
    <title>{{ $title }}</title>
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
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="checkout-caption">
                        <h3>Đơn hàng</h3>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            $content = Cart::content();
        ?>
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Sản Phẩm ({{count($content)}})</th>
                                <th style="text-align:center">Đơn giá</th>
                                <th style="text-align:center">Số lượng</th>
                                <th style="text-align:center">Thành Tiền</th>
                            </tr>
                            @foreach($content as $contents)
                            <tr>
                                <td>
                                    <div class="media d-flex">
                                        <div class="cart-img" style="background-image: url({{asset('images/home/'  . $contents->options->image)}});"></div>
                                            <div class="cart-name">
                                                <h5>{{ $contents->name }}</h5>
                                                <label for="cars">Size: {{ $contents->options->size }} inch</label>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td style="text-align:center">
                                    <p>{{  number_format($contents->price) . 'vnđ'   }}</p>
                                </td>
                                <td style="text-align:center">
                                    <p>{{ $contents->qty }}</p>
                                </td>
                                <td style="text-align:center">
                                    <p>
                                    <?php
                                        $total = 0;
                                        if($contents->options->size == 6){
                                            $price = $contents->price *  1.6;
                                    
                                        }else if($contents->options->size == 5){
                                            $price = $contents->price *  1.5;
                                            
                                        }else if($contents->options->size == 4){
                                            $price = $contents->price *  1.4;
                                            
                                        }else if($contents->options->size == 3){
                                            $price = $contents->price *  1.3;

                                        }else if($contents->options->size == 2){
                                            $price = $contents->price *  1.2;
                                        }
                                        else{
                                            $price = $contents->price;
                                        }
                                        $total =  $price * $contents->qty;
                                        echo number_format($total) . 'vnđ';
                                        
                                    ?>
                                    </p>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-12">
                    <div class="checkout-form">
                        <div class="row">
                            <form action="{{route('check-coupon')}}" method="post" id="frmCheckCoupon">
                                @csrf
                                <?php
                                    $total = 0;
                                    foreach($content as $contents){
                                        if($contents->options->size == 6){
                                            $price = $contents->price *  1.6;
                                    
                                        }else if($contents->options->size == 5){
                                            $price = $contents->price *  1.5;
                                            
                                        }else if($contents->options->size == 4){
                                            $price = $contents->price *  1.4;
                                            
                                        }else if($contents->options->size == 3){
                                            $price = $contents->price *  1.3;
        
                                        }else if($contents->options->size == 2){
                                            $price = $contents->price *  1.2;
                                        }
                                        else{
                                            $price = $contents->price;
                                        }
                                        $total +=  $price * $contents->qty;
                                    }
                                ?>
                                <input type="hidden" value="{{$total}}" name="price" id="price">
                                <div class="form-floating mb-3 d-flex" style="float: right;">
                                    <div class="input-group" style="align-items: normal;width: 100%;padding-right: 25px">
                                        <div id="coupons" style="">
                                            <input type="text" name="code" id="code" class="form-control" aria-label="Text input with segmented dropdown button" style="margin: 0px 0 0px 0; padding: 5px 15px;text-align: left; background: #f2f2f2;border-bottom: 1px solid; width: 100%;" placeholder="Nhập mã giảm giá">
                                            <br>
                                            <br>
                                            <i style="color:red; font-size: 13px">* Lưu ý mã giảm giá chỉ áp dụng cho tổng tiền hàng</i>
                                        </div>
                                        <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false" style="height: 2.4rem;padding: 10px;">
                                            <span class="visually-hidden">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end" id="click-coupon">
                                            @foreach($coupon as $coupons)
                                                <li value="{{$coupons->id}}" id="choice">
                                                    <span class="dropdown-item" style="cursor:pointer;">{{$coupons->code}} - {{$coupons->name}} 
                                                    @if($coupons->code=="LAKE015")
                                                        áp dụng cho đơn hàng từ 400.000 VNĐ
                                                    @elseif($coupons->code=="LAKE030")
                                                        áp dụng cho đơn hàng từ 600.000 VNĐ
                                                    @elseif($coupons->code=="LAKE050")
                                                        áp dụng cho đơn hàng từ 800.000 VNĐ
                                                    @endif
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="check_coupon">
                                        <input type="submit" name="check_coupon" value="Áp dụng" style="padding: 6px  20px;">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{route('save-checkout')}}" method="post" id="frmSaveCheckout" enctype="application/x-www-form-urlencoded">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xxl-12">
                        <div class="content-pay checkout-form">
                            <table border="0" style="float: right;">
                                <form action="{{route('save-checkout')}}" method="POST" id="frmSaveCheckout">
                                    @csrf
                                    <tr>
                                        <td style="padding-right: 50px;">Tổng Tiền Hàng: </td>
                                        <td style="float: right;">
                                        <?php
                                            $total = 0;
                                            foreach($content as $contents){
                                                if($contents->options->size == 6){
                                                    $price = $contents->price *  1.6;
                                            
                                                }else if($contents->options->size == 5){
                                                    $price = $contents->price *  1.5;
                                                    
                                                }else if($contents->options->size == 4){
                                                    $price = $contents->price *  1.4;
                                                    
                                                }else if($contents->options->size == 3){
                                                    $price = $contents->price *  1.3;
                
                                                }else if($contents->options->size == 2){
                                                    $price = $contents->price *  1.2;
                                                }
                                                else{
                                                    $price = $contents->price;
                                                }
                                                $total +=  $price * $contents->qty;
                                            }
                                            echo number_format($total) . ' vnđ';
                                        ?>
                                        </td>
                                    </tr>
                                    <tr id="coupon-code">
                                        <td style="padding-right: 50px;">
                                            @if(session()->has('coupon'))
                                                @foreach(session()->get('coupon') as $key => $cou)
                                                    @if($cou['value']==1)
                                                        <p style="padding-right: 50px;" class="coupon-code">Mã Giảm Giá: {{$cou['code']}}
                                                            @if(session()->has('coupon'))
                                                                <a href="#" style="text-decoration: none; color: red;" class="unset-coupon" data-coupon_code="{{$cou['code']}}"><i>[remove]</i></a>
                                                            @endif
                                                        </p>
                                                    @else
                                                        <p style="padding-right: 50px;" class="coupon-code">Mã Giảm Giá:  {{$cou['code']}}
                                                            @if(session()->has('coupon'))
                                                                <span href="#" style="text-decoration: none; color: red; cursor: pointer;" class="unset-coupon" data-coupon_code="{{$cou['code']}}"><i>[remove]</i></span>
                                                            @endif
                                                        </p>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                        <td style="float: right;">
                                            @if(session()->has('coupon'))
                                                @foreach(session()->get('coupon') as $key => $cou)
                                                    @if($cou['value']==2)
                                                        <p style="">-{{number_format($cou['discount'])}} vnđ</p>
                                                    @else
                                                        <p style="">{{$cou['discount']}} %</p>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-right: 50px;">Phí Vận Chuyển: </td>
                                        <td style="float: right;">
                                            <?php
                                                $ship = 0;
                                                if($total >= 400000){
                                                    $ship = 0;
                                                    echo 'Miễn Phí';
                                                }else{
                                                    $ship = 30000;
                                                    echo number_format($ship) . ' vnđ';
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Thuế (VAT): </td>
                                        <td style="float:right">
                                        <?php
                                            $vat = $total * 0.05;
                                            echo number_format($vat) . ' vnđ';
                                        ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tổng Thanh Toán: </td>
                                            <td style="float: right; color: brown" id="pay">
                                                <?php
                                                    $total_coupon = $total;
                                                    if(session()->has('coupon')){
                                                        foreach(session()->get('coupon') as $key => $cou){
                                                            if($cou['value']==2){
                                                                $total_coupon = $total - $cou['discount'];
                                                            }else{
                                                                $total_coupon = $total - ($total * $cou['discount'])/100;
                                                            }
                                                        }
                                                    }else{
                                                        $total_coupon = $total;
                                                    }
                                                    $total_all = $total_coupon + $ship + $vat;
                                                    echo '<span class="text-danger" style="font-size: 20px;">'.number_format($total_all).' vnđ</span>';
                                                ?>
                                            </td>
                                            <input type="hidden" value="{{$total_all}}" name="total_all"/>
                                        </td>
                                    </tr>
                                </form>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <h3>Địa chỉ nhận hàng</h3>
                    <div class="col-xxl-12">
                        <div>
                            @csrf
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="single-form" style="margin: 5px 0 22px 0;">
                                        <input type="email" placeholder="Email" name="email" style="margin:0">
                                        @if($errors->has('email'))
                                            <p class="text-danger">{{$errors->first('email')}}</p>
                                        @endif
                                        <!-- <div class="" style="color: red;"><i> {{ session('error') }}</i></div> -->
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="single-form" style="margin: 5px 0 22px 0;">
                                        <input type="text" placeholder="Số điện thoại" name="phone" style="margin:0" >
                                        @if($errors->has('phone'))
                                            <p class="text-danger">{{$errors->first('phone')}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="single-form" style="margin: 5px 0 22px 0;">
                                        <input type="text" placeholder="Họ và tên" name="name" style="margin:0" >
                                        @if($errors->has('name'))
                                            <p class="text-danger">{{$errors->first('name')}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="single-form" style="margin: 5px 0 22px 0;">
                                        <input type="text" placeholder="Địa chỉ" name="address" style="margin:0" >
                                        @if($errors->has('address'))
                                            <p class="text-danger">{{$errors->first('address')}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-12 " style="    margin: 5px 0 22px 0;">
                                    <select style="width:100%;" id="city" name="city">
                                        <option value="">Chọn Tỉnh/Thành phố</option>
                                        @foreach($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('city'))
                                        <p class="text-danger">{{$errors->first('city')}}</p>
                                    @endif
                                </div>

                                <div class="col-xl-12" style="    margin: 5px 0 22px 0;">
                                    <select style="width:100%;" id="district" name="district">
                                        <option value="">Chọn Quận/Huyện</option>
                                        @foreach($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('district'))
                                        <p class="text-danger">{{$errors->first('district')}}</p>
                                    @endif
                                </div>
                                <div class="col-xl-12" style="    margin: 5px 0 22px 0;">
                                    <select style="width:100%;" id="ward" name="ward">
                                        <option value="">Chọn Xã/Phường</option>
                                        @foreach($wards as $ward)
                                        <option value="{{ $ward->id }}">{{ $ward->name }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('ward'))
                                        <p class="text-danger">{{$errors->first('ward')}}</p>
                                    @endif
                                </div>
                                <div class="col-xl-12">
                                    <div class="single-form">
                                        <textarea id="message" name="message" placeholder="Write something.." style="height:200px; width: 100%;"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <h3>Phương Thức Thanh Toán</h3>
                    <div class="col-xxl-12">
                        <div class="checkout-form">
                            <div class="row">
                                <div>
                                    <div class="single-form">
                                        <input type="radio" name="payment" value="0" checked>
                                        <label for="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng (COD)</label>
                                    </div>
                                </div>
                                <div>
                                    <hr>
                                    <div class="single-form">
                                        <input type="radio" name="payment" value="1">
                                        <label for="Thanh toán qua thẻ">Thanh toán qua VNPAY</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xxl-12">
                    <div class="content-pay checkout-form">
                        <div class="row">
                            <div class="col-xxl-12">
                                <div class="single-form-r">
                                    <button type="submit" class="btn" form="frmSaveCheckout" name="redirect">Đặt Hàng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('layout.footer')
</body>


</html>