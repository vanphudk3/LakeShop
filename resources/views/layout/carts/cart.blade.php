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
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="section-tittle text-center">
                        <h3>Giỏ Hàng</h3>
                    </div>
                </div>
            </div>
        </div>
        @if(Cart::count() > 0)
        <div class="menu-cart">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="table-responsive">
                            <?php
                                $content = Cart::content();
                            ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Sản Phẩm ({{(count($content))}})</th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Số Lượng</th>
                                        <th scope="col">Thành Tiền</th>
                                        <th scope="col">Xóa</th>
                                    </tr>
                                </thead>
                                <tbody id="quantity">
                                    @foreach($content as $contents)
                                    <tr>
                                        <td scope="row" class="d-flex">
                                            <div class="cart-img" style="background-image: url({{asset('images/home/'  . $contents->options->image)}});"></div>
                                            <div class="cart-name">
                                                <h5>{{ $contents->name }}</h5>
                                                <label for="cars">Size: {{ $contents->options->size }} inch</label>
                                            </div>
                                        </td>
                                        <td>{{ number_format($contents->price)  . 'vnđ'}}</td>
                                        <td>
                                            <div class="input-group" style="flex-wrap: inherit;">
                                                <div class="input-group-prepend">
                                                    <input type="hidden" value="{{$contents->rowId}}" id="rowId">
                                                    <button class="btn btn-outline-secondary decrease"  type="button" id="" value="{{$contents->rowId}}">-</button>
                                                </div>
                                                <div class="change-qty">
                                                    <input type="hidden" name="product_id_hidden"  class="product_id_hidden_{{$contents->rowId}}" value="{{$contents->id}}">
                                                    <input type="Number" name="qty" class="form-control qty" placeholder="" aria-label="Example text with button addon" id="qty" aria-describedby="button-addon1" style="border-radius: 0;" value="{{  $contents->qty  }}" data-id_qty="{{$contents->rowId}}" title="Quantity:" readonly>
                                                </div>
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-outline-secondary increase" type="button" id="" value="{{$contents->rowId}}">+</button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
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
                                                echo number_format($total)  . 'vnđ';
                                            ?>
                                        </td>
                                        <td><a href="{{  route('delete-cart' , $contents->rowId)   }}" style="color: #f2f2f2;"><i class="fas fa-trash-alt"></i></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xxl-12">
                    <div class="content-pay  checkout-form">
                        <table  border="0" style="float: right;">
                            <tr>
                                <td>Tổng Sản Phẩm: </td>
                                <td style="float: right;">{{    Cart::count()   }}</td>
                            </tr>
                            <tr>
                                <td>Tạm Tính: </td>
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
                                    echo number_format($total)  . 'vnđ';
                                ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Thanh Toán: </td>
                                <td style="float: right;" colspan="3">
                                    <a href="{{  route('checkout')   }}" class="btn-contracts">Thanh Toán</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xxl-12">
                    <div class="content-pay  checkout-form text-center">
                        <img src="https://fansport.vn/default/template/img/cart-empty.png" alt="" height="">
                        <p>Không có sản phẩm nào trong giỏ hàng của bạn</p>
                        <a href="{{  route('home')   }}" class="btn-contracts">Tiếp tục mua hàng</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </main>
    @include('layout.footer')
</body>
</html>