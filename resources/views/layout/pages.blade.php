

<script src="{{asset('js/swiper-bundle.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/stype.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".slide-content", {
      slidesPerView: 3,
      spaceBetween: 10,
      slidesPerGroup: 3,
      loop: true,
      loopFillGroupWithBlank: true,
      fade:'true',
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints:{
        0:{
          slidesPerView:1,

        },
        520:{
          slidesPerView:2,

        },
        950:{
          slidesPerView:3,

        },
      },
    });
  </script>

<script>
    var swiper = new Swiper(".slide-content-r", {
      slidesPerView: 3,
      spaceBetween: 10,
      slidesPerGroup: 3,
      loop: true,
      loopFillGroupWithBlank: true,
      fade:'true',
      pagination: {
        el: ".swiper-pagination-r",
        clickable: true,
        dynamicBullets: true,
      },
      navigation: {
        nextEl: ".swiper-button-next-r",
        prevEl: ".swiper-button-prev-r",
      },
      breakpoints:{
        0:{
          slidesPerView:1,

        },
        520:{
          slidesPerView:2,

        },
        950:{
          slidesPerView:3,

        },
      },
    });
  </script>
  <script>
    function increased(){
        var result = document.getElementById('sst'); 
        var sst = result.value; 
        if( !isNaN( sst )) 
            result.value++;
        return false;
    }

  </script>
  <script src="https://code.jquery.com/jquery-latest.js"></script>
  <script type="text/javascript">
    // $(document).ready(function(){
      
    // })
    $('#frmcart').submit(function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serialize();
        let route = '{{ route('update-quantity-cart') }}'
        console.log(data);
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function(data){
              console.log(data);
              $status = data.status;
              $message = data.message;
              $count_cart = data.count_cart;
              //console.log($count_cart);
              if($status == true){
                //console.log(qty);
                swal({
                    title: "Thêm vào giỏ hàng thành công!",
                    text: "Bạn có thể tiếp tục mua hàng hoặc đến giỏ hàng để thanh toán!",
                    showCancelButton: true,
                    type: "success",
                    cancelButtonText: "Xem tiếp",
                    confirmButtonClass: "btn-warinng",
                    confirmButtonText: "Đi đến giỏ hàng",
                    closeOnConfirm: false
                },
                function(){
                    window.location.href = "{{url('/cart')}}";
                });
                $('#count').html($count_cart);
              }
              else{
                swal("Thất bại!", $message, "error");
              }
              if(qty <= 0){
                swal("Thất bại!", "Số lượng sản phẩm không hợp lệ!", "error");
              }
              if(warehouse <= 0){
                swal({
                  title: "Thất bại!",
                  text: "Sản phẩm này đã hết hàng. Vui lòng chọn sản phẩm khác!",
                  type: "error",
                  showCancelButton: true,
                  cancelButtonText: "Xem tiếp",
                  confirmButtonClass: "btn-warinng",
                  confirmButtonText: "Đi đến trang chủ",
                  closeOnConfirm: false
                },
                function(){
                  window.location.href = "{{url('/')}}";
                });
              
              }
            }
        });
    });
  </script>

  <!-- check password -->
<script>
    function onChange() {
        const password = document.querySelector('input[name=password]');
        const confirm = document.querySelector('input[name=re_password]');
        if (confirm.value === password.value) {
            confirm.setCustomValidity('');
        } else {
            confirm.setCustomValidity('Passwords do not match');
        }
    }
</script>
<script>
    // Disable form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Get the forms we want to add validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
    </script>

<script>
  function myFunction() {
      var x = document.getElementById("myTopnav");
      if (x.className === "topnav") {
      x.className += " responsive";
      } else {
      x.className = "topnav";
      }
  }
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>


<script type="text/javascript">
  $(document).ready(function(){
    if($('#city').val() == 0){
      $('#district').attr('disabled', true);
      $('#city').change(
        function(){
          if($(this).val() != 0){
            $('#district').attr('disabled', false);
          }
        }
      );
      if($('#district').val() == 0){
        $('#ward').attr('disabled', true);
        $('#district').change(
          function(){
            if($(this).val() != 0){
              $('#ward').attr('disabled', false);
            }
          }
        );
      }

    }
    $('#city').change(function(){
      let city_id = $(this).val();
      let route = '{{route('processdistrict')}}';
      
      $.ajax({
        url: route,
        type: 'GET',
        data: {city_id: city_id},
        dataType: 'json',
        success: function(data){
          $("#district").html("");
          $("#district").append('<option value="">Chọn Quận/Huyện</option>');
          $.each(data.districts, function(key, value){
            let select = "";
            select+= '<option value="'+value.id+'">'+value.name+'</option>';
            $("#district").append(select);
          });
          console.log(data);
        }
      });
    });
    
    $('#district').change(function(){
      let district_id = $(this).val();
      let route = '{{route('processward')}}';
      
      $.ajax({
        url: route,
        type: 'GET',
        data: {district_id: district_id},
        dataType: 'json',
        success: function(data){
          $("#ward").html("");
          $("#ward").append('<option value="">Chọn Xã/Phường</option>');
          $.each(data.wards, function(key, value){
            let select = "";
            select+= '<option value="'+value.id+'">'+value.name+'</option>';
            $("#ward").append(select);
          });
          console.log(data);
        }
      });
    });
  })
</script>
<script type="text/javascript">
  $(document).ready(function(){
    const element = document.querySelectorAll('#choice');
    if (element.length !== 0) {
      for (var i=0; i<element.length; i++) {
        element[i].addEventListener('click', function () {
          $choice_id = $(this).val();
          console.log($choice_id);
          $.ajax({
            url: '{{ route('choice') }}',
            type: 'GET',
            data: {choice_id: $choice_id},
            dataType: 'json',
            success: function(data){
              console.log(data.data['code']);
              $('#coupons').html("");
              $('#coupons').append('<input type="text" name="code" id="code" placeholder="Nhập mã giảm giá" id="coupons" class="form-control" aria-label="Text input with segmented dropdown button" style="margin: 0px 0 0px 0; padding: 5px 15px;text-align: left; background: #f2f2f2;border-bottom: 1px solid;" value="'+data.data['code']+'"><br> <br> <i style="color:red; font-size: 13px">* Lưu ý mã giảm giá chỉ áp dụng cho tổng tiền hàng</i>');
            },  
            error: function(error){
              console.log(error);
            },
          });
        });
      }
    }

  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#frmCheckCoupon').submit(function(e){
      e.preventDefault();
      var code = $('#code').val();
      var price = $('#price').val();
      var url = $(this).attr('action');
      var data = $(this).serialize();
      $.ajax({
        url: url,
        type: 'POST',
        data: data,
        success: function(data){
          $status = data.status;
          $message = data.message;
          if($status){
            swal({
              title: "Thành công!",
              text: $message,
              type: "success",
              button: "OK",
            },
            function(){
              location.reload();
            });
          }
          else{
            swal("Thất bại!", $message, "error");
          }
          console.log(data);
        }
      })
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('.unset-coupon').click(function(){
      var data = $(this).attr('data-coupon_code');
      var route = '{{route('unset-coupon')}}';
      $total = "<?php 
        $content = Cart::content();
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
        $ship = 0;
        if($total >= 400000){
            $ship = 0;
        }else{
            $ship = 30;
        }
        $vat = $total * 0.05;
        $total_all = $total + $ship + $vat;
        echo number_format($total_all);
      ?>";
      console.log($total);
      $.ajax({
        url: route,
        type: 'GET',
        data: {data: data},
        dataType: 'json',
        
        success: function(data){
          console.log(data);
          $('#pay').html("");
          $('#coupon-code').html("");
          var nf = new Intl.NumberFormat();
          $newpay = $total;
          $('#pay').append('<span class="text-danger" style="font-size: 20px;">'+$newpay+' vnđ</span><input type="hidden" value='+$newpay+' name="total_all"/>');

        },
        error: function(error){
          console.log(error);
        }
      });
    });
  })
</script>



<script src="{{asset('js/jquery.validate.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
	$('#frmSaveCheckout').validate({
		rules:{
        name : {
          required: true,
          minlength: 2,
          maxlength: 50,
        },
        phone : {
          required: true,
          minlength: 10,
          maxlength: 11,
        },
        email : {
          required: true,
          email: true,
        },
        address : {
          required: true,
          minlength: 10,
          maxlength: 100,
        },
				city : {required: true },
				district :{required: true },
				ward:{required: true },

			},
		messages:{
      name: {
        required: "Vui lòng nhập tên của bạn",
        minlength: "Tên của bạn phải có ít nhất 2 ký tự",
        maxlength: "Tên của bạn không được vượt quá 50 ký tự",
      },
      phone: {
        required: "Vui lòng nhập số điện thoại của bạn",
        minlength: "Số điện thoại của bạn phải có ít nhất 10 ký tự",
        maxlength: "Số điện thoại của bạn không được vượt quá 11 ký tự",
      },
      email: {
        required: "Vui lòng nhập email của bạn",
        email: "Email của bạn không đúng định dạng",
      },
      address: {
        required: "Vui lòng nhập địa chỉ của bạn",
        minlength: "Địa chỉ của bạn phải có ít nhất 10 ký tự",
        maxlength: "Địa chỉ của bạn không được vượt quá 100 ký tự",
      },
			city: "Bạn Chưa Chọn Thành Phố",
			district: "Bạn Chưa Chọn Huyện",
			ward:	"Bạn Chưa Chọn Xã"
		},
	errorElement: "div",
	errorPlacement: function(error, element){
					error.addClass("invalid-feedback");
					if(element.prop("type") ==="checkbox"){
						error.insertAfter(element.siblings("label"));
					}else {
						error.insertAfter(element);
					}
				},
	highlight: function(element, errorClass, validClass){
					$(element).addClass("is-invalid").removeClass("is-valid");
				},
	unhighlight: function(element, errorClass, validClass){
					$(element).addClass("is-valid").removeClass("is-invalid");
				}
	});
});

</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#frmsearch-order').submit(function(e){
      e.stopPropagation();
      return false;
    });
  });
  $(document).ready(function(){
    $('#rangePrimary').keyup(function(){
      var search = $(this).val();
      console.log(search);
      $.ajax({
        url: '{{route('admin-search')}}',
        type: 'GET',
        data: {search: search},
        dataType: 'json',
        success: function(data){
          console.log(data);
          // $('#table_user').html("");
          $status = data.status;
          $message = data.message;
          $('#user').html(data.html);
        },
        error: function(error){
          console.log(error);
        }
      });
    })
  })
</script>

<script type="text/javascript">
  $('.decrease').click(function(){
    var type = 'decre';
    var rowId = $(this).val();
    var qty = $('.qty').val();
    var product_id_hidden = $('.product_id_hidden_'+rowId).val();
    $.ajax({
      url: '{{route('update-qty')}}',
      type: 'GET',
      data: {rowId: rowId, type: type, qty: qty, product_id_hidden: product_id_hidden},
      dataType: 'json',
      success: function(data){
        $product = data.product;
        console.log(data.product);
        if(data.product < 1){
            swal({
              title: "Thông Báo",
              text: "Bạn thật sự muốn xóa sản phẩm này khỏi giỏ hàng?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
        }
        $('#quantity').html(data.html);
        $('.content-pay').html(data.html1);
        //$('.badge').html(data.header);
      },
      error: function(error){
        console.log(error);
      }
    });
    // console.log(rowId);
  })
</script>
<script type="text/javascript">
  $('.increase').click(function(){
    var type = 'incre';
    var rowId = $(this).val();
    var qty = $('.qty').val();
    var product_id_hidden = $('.product_id_hidden_'+rowId).val();
    
    $.ajax({
      url: '{{route('update-qty')}}',
      type: 'GET',
      data: {rowId: rowId, type: type, qty: qty, product_id_hidden: product_id_hidden},
      dataType: 'json',
      success: function(data){
        $message = data.message;
        $status = data.status;
        $product = data.product;
        console.log(data.product);
        if($status==false){
          swal('Rất tiếc', 'Sản phẩm này chỉ còn '+$product+ ' sản phẩm trong kho', 'error');
        }
        $('#quantity').html(data.html);
        $('.content-pay').html(data.html1);
      },
      error: function(error){
        console.log(error);
      }
    });
    // console.log(rowId);
  })
</script>

