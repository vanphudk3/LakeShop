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