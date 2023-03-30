@extends('layout.pages')
{{-- <input type="Number" name="qty" class="form-control" placeholder="" aria-label="Example text with button addon" id="qty" aria-describedby="button-addon1" value="{{  $qty  }}" style="border-radius: 0;" title="Quantity:" readonly> --}}
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
                    <button class="btn btn-outline-secondary decrease" type="button" id="" value="{{$contents->rowId}}">-</button>
                </div>
                <div class="change-qty">
                    <input type="hidden" name="product_id_hidden"  class="product_id_hidden_{{$contents->rowId}}" value="{{$contents->id}}">
                    <input type="Number" name="qty" class="form-control qty" placeholder="" aria-label="Example text with button addon" id="qty" aria-describedby="button-addon1" style="border-radius: 0;" value="{{  $contents->qty  }}" title="Quantity:" readonly>
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
