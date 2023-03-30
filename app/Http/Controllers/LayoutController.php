<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\CheckoutRequest;
use App\Models\admin;
use App\Models\cities;
use App\Models\Coupon;
use App\Models\order;
use App\Models\transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\customer;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Customer\RegisterRequest;
use App\Http\Requests\Customer\LoginRequest;
use App\Models\product;
use Illuminate\Support\Facades\View;
use Mail;
use Symfony\Component\Console\Input\Input;
use App\Models\Size;
use Cart;
use Termwind\Components\Dd;
use App\Models\ward;
use Illuminate\Support\Facades\DB;
use App\Models\districts;
use Illuminate\Support\Facades\Route;

class LayoutController extends Controller
{
    // private string $title = 'Home';
    public function __construct()
    {
        $router = Route::currentRouteName();
        $arr = explode('.', $router);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' - ', $arr);
        View::share('title', $title);
    }

    public function index()
    {
        $product_new = product::take(6)
            ->orderBy('id', 'desc')
            ->get();
        $product = DB::table('orders')
            ->join('products', 'orders.product_id', 'products.id')
            ->select(DB::raw('sum(orders.quantity) as total'), 'orders.product_id', 'products.name', 'products.image', 'products.price', 'products.quantity', 'products.status', 'products.created_at')
            ->groupBy('orders.product_id', 'products.name', 'products.image', 'products.price', 'products.quantity', 'products.status', 'products.created_at')
            ->orderByRaw('total DESC')
            ->take(6)
            ->get();
        //dd($product);
        return view('layout/index', [
            'product' => $product,
            'product_new' => $product_new

        ]);
    }

    public function product()
    {
        $product = product::paginate(6);
        return view('layout/products/product', [
            'product' => $product,
        ]);
    }

    public function productDetail(Product $product)
    {
        $products = product::find($product);
        $pt = product::all()->except($product->id);
        $size = Size::all();
        return view('layout/products/product-detail', compact('product'), [
            'pt' => $pt,
            'size' => $size,
        ]);
    }

    public function update_qty_ajax(Request $request)
    {
        $qty = $request->product_qty;
        $count = Cart::count() + $qty;
        dd($count);
        return response()->json($count);

    }


    public function update_qty(Request $request)
    {
        $content = Cart::content();
        $rowId = $request->rowId;
        $type = $request->type;
        $qty1 = $request->qty;
        $html = view('layout.carts.update-qty-product', compact('content'))->render();
        $html1 = view('layout.carts.total-price', compact('content'))->render();
        foreach ($content as $item) {
            $product = product::find($request->product_id_hidden)->quantity;
            if ($item->rowId == $rowId) {
                $qty = $item->qty;

                if ($type === 'decre') {
                    if ($qty > 1) {
                        $qty = $qty - 1;
                        Cart::update($rowId, $qty);
                    } else {
                        $cart = Cart::content()->where('rowId', $rowId);
                        if ($cart->isNotEmpty()) {
                            Cart::remove($rowId);
                        }
                    }
                } elseif ($type === 'incre') {
                    if ($qty < $product) {
                        $qty = $qty + 1;
                        Cart::update($rowId, $qty);
                    } else {
                        $qty = $qty;
                        Cart::update($rowId, $qty);
                        return response()->json([
                            'message' => 'Rất tiếc, chỉ có thể mua tối đa sản phẩm trong kho',
                            'status' => false,
                            'product' => $product
                        ]);
                    }
                }
            }
        }
        $html = view('layout.carts.update-qty-product', compact('content'))->render();
        $html1 = view('layout.carts.total-price', compact('content'))->render();
        return response()->json([
            'html' => $html,
            'html1' => $html1,
            'product' => $product
        ]);
    }

    public function cart(Request $request)
    {
        return view('layout/carts/cart');
    }

    public function save_cart(Request $request)
    {
        $rowId = $request->rowId;
        $productId = $request->product_id_hidden;
        $quantity = $request->qty;
        $size = $request->ssz;
        $content = Cart::content();
        $product_infor = product::find($productId);
        if ($product_infor->quantity < $quantity) {
            return response()->json([
                'message' => 'Số lượng sản phẩm trong kho không đủ',
                'status' => false
            ]);
        }
        $data['id'] = $product_infor->id;
        $data['name'] = $product_infor->name;
        $data['qty'] = $quantity;
        $data['price'] = $product_infor->price;
        $data['weight'] = 0;
        $data['options']['size'] = $size;
        $data['options']['image'] = $product_infor->image;
        if ($quantity <= 0) {
            return response()->json([
                'message' => 'Số lượng sản phẩm trong kho không đủ',
                'status' => false,
            ]);
        } else {
            foreach ($content as $item) {
                if ($item->id == $productId && $item->options->size == $size) {
                    $qty = $item->qty;
                    $qty = $qty + $quantity;
                    if ($qty > $product_infor->quantity) {
                        return response()->json([
                            'message' => 'Bạn đã có ' . $item->qty . ' sản phẩm trong giỏ hàng. 
                            Không thể thêm số lượng đã chọn vào giỏ hàng vì sẽ vượt quá số lượng sản phẩm trong kho.',
                            'status' => false,
                        ]);

                    } else {
                        return response()->json([
                            'message' => 'Thêm sản phẩm vào giỏ hàng thành công',
                            'status' => true,
                        ]);
                    }
                }
            }
            Cart::add($data);
            $count_cart = count($content);
            return response()->json([
                'message' => 'Thêm sản phẩm vào giỏ hàng thành công',
                'status' => true,
                'count_cart' => $count_cart
            ]);
        }
    }
    public function delete_cart($rowId)
    {
        Cart::update($rowId, 0);
        $coupon = session()->get('coupon');
            if ($coupon == true) {
                session()->forget('coupon');
            }
        return view('layout/carts/cart');
    }

    public function checkout(Request $request)
    {
        $coupon = DB::table('coupons')->get();
        $cities = DB::table('cities')->get();
        $districts = DB::table('districts')->get();
        $wards = DB::table('wards')->get();
        return view('layout/carts/checkout', [
            'cities' => $cities,
            'districts' => $districts,
            'wards' => $wards,
            'coupon' => $coupon,
        ]);
    }

    public function choice(Request $request)
    {
        $choice = $request->choice_id;
        $data = Coupon::find($choice);
        return response()->json([
            'data' => $data
        ]);
    }

    public function check_coupon(Request $request)
    {
        $coupon = DB::table('coupons')->where('code', $request->code)->first();
        $price = $request->price;
        if ($coupon) {
            $count = DB::table('coupons')->where('code', $request->code)->count();

            if ($count > 0) {
                if ($coupon->code == "LAKE015" && $price >= 400000)
                    $coupon_session = session()->get('coupon');
                else if ($coupon->code == "LAKE030" && $price >= 600000)
                    $coupon_session = session()->get('coupon');
                else if ($coupon->code == "LAKE050" && $price >= 800000)
                    $coupon_session = session()->get('coupon');
                else {
                    return response()->json([
                        'message' => 'Mã giảm giá không áp dụng cho đơn hàng này',
                        'status' => false
                    ]);
                }
                if ($coupon_session == true) {
                    $is_avaiable = 0;
                    if ($is_avaiable == 0) {
                        $cou[] = array(
                            'code' => $coupon->code,
                            'value' => $coupon->value,
                            'discount' => $coupon->discount,
                        );
                        session()->put('coupon', $cou);
                    }
                } else {
                    $cou[] = array(
                        'code' => $coupon->code,
                        'value' => $coupon->value,
                        'discount' => $coupon->discount,
                    );
                    session()->put('coupon', $cou);
                }
                session()->save();
                return response()->json([
                    'message' => 'Mã giảm giá đã được áp dụng',
                    'status' => true
                ]);
            }

        } else {
            return response()->json([
                'message' => 'Mã giảm giá không tồn tại',
                'status' => false
            ]);
        }
    }

    public function unset_coupon(Request $request)
    {
        $data = $request->data;
        $code = coupon::where('code', $data)->first();
        $coupon = session()->get('coupon');
        if ($coupon == true) {
            session()->forget('coupon');
        }
        return response()->json([
            'code' => $code
        ]);
    }

    public function processcity(Request $request)
    {
        dd($request->all());
    }

    public function processdistrict(Request $request)
    {
        $id = $request->city_id;
        $districts = districts::where('city_id', $id)->get();
        return response()->json(['districts' => $districts]);
    }

    public function processward(Request $request)
    {
        $id = $request->district_id;
        $wards = ward::where('district_id', $id)->get();
        return response()->json(['wards' => $wards]);
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function save_checkout(CheckoutRequest $request)
    {
        $data = $request->all();

        $content = Cart::content();

        $city = cities::where('id', $data['city'])->get('name');
        $district = districts::where('id', $data['district'])->get('name');
        $ward = ward::where('id', $data['ward'])->get('name');
        $address = $data['address'];
        foreach ($ward as $war) {
            $wa = $war;
        }
        $re_ward = ($wa['name']);
        foreach ($district as $distric) {
            $dis = $distric;
        }
        $re_district = ($dis['name']);
        foreach ($city as $cit) {
            $ci = $cit;
        }
        $re_city = ($ci['name']);
        $transaction = new transaction();
        if ($data['payment'] == 0) {
            if (session()->get('id')) {
                $customer_id = session()->get('id');
                $transaction->customer_id = $customer_id;
            }
            $transaction->re_email = $data['email'];
            $transaction->re_name = $data['name'];
            $transaction->re_phone = $data['phone'];
            $transaction->re_address = $address . ', ' . $re_ward . ', ' . $re_district . ', ' . $re_city;
            $transaction->total_price = $data['total_all'];
            $transaction->message = $data['message'];
            $transaction->payment_method = $data['payment'];
            $transaction->status = 'pending';
            $transaction->payment_status = 'pending';
            if ($transaction->save()) {
                foreach ($content as $key => $value) {
                    $order = new order();
                    $order->transaction_id = $transaction->id;
                    $order->product_id = $value->id;
                    $order->quantity = $value->qty;
                    $order->size_id = $value->options->size;
                    $order->status = 'pending';
                    $order->save();
                }
                Cart::destroy();
                $coupon = session()->get('coupon');
                if ($coupon == true) {
                    session()->forget('coupon');
                }
                return redirect()->route('home');
            } else {
                return redirect()->back();
            }
        } else {
            $transaction->re_email = $data['email'];
            $transaction->re_name = $data['name'];
            $transaction->re_phone = $data['phone'];
            $transaction->re_address = $address . ',' . $re_ward . ',' . $re_district . ',' . $re_city;
            $transaction->total_price = $data['total_all'];
            $transaction->message = $data['message'];
            $transaction->payment_method = $data['payment'];
            $transaction->status = 'pending';
            $transaction->payment_status = 'pending';
            if ($transaction->save()) {
                foreach ($content as $key => $value) {
                    $order = new order();
                    $order->transaction_id = $transaction->id;
                    $order->product_id = $value->id;
                    $order->quantity = $value->qty;
                    $order->size_id = $value->options->size;
                    $order->status = 'pending';
                    $order->save();
                }
                // Pay VNPAY
                $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                $vnp_Returnurl = "http://127.0.0.1:8000/vnpay-return";
                $vnp_TmnCode = "CHY8RJDX"; //Mã website tại VNPAY 
                $vnp_HashSecret = "OHVGFFGRCSFFHBCWQYANFOUBVFDFRJJQ"; //Chuỗi bí mật
                $tran_id = DB::table('transactions')->orderBy('id', 'desc')->first('id');
                $vnp_TxnRef = $transaction->id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
                $vnp_OrderInfo = 'Thanh toán qua VNPAY';
                $vnp_OrderType = 'billpayment';
                $vnp_Amount = $data['total_all'] * 100;
                $vnp_Locale = 'vn';
                // $vnp_BankCode = 'ACB';
                $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
                //Add Params of 2.0.1 Version
                //$vnp_ExpireDate = $_POST['txtexpire'];
                //Billing

                $inputData = array(
                    "vnp_Version" => "2.1.0",
                    "vnp_TmnCode" => $vnp_TmnCode,
                    "vnp_Amount" => $vnp_Amount,
                    "vnp_Command" => "pay",
                    "vnp_CreateDate" => date('YmdHis'),
                    "vnp_CurrCode" => "VND",
                    "vnp_IpAddr" => $vnp_IpAddr,
                    "vnp_Locale" => $vnp_Locale,
                    "vnp_OrderInfo" => $vnp_OrderInfo,
                    "vnp_OrderType" => $vnp_OrderType,
                    "vnp_ReturnUrl" => $vnp_Returnurl,
                    "vnp_TxnRef" => $vnp_TxnRef
                );

                if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                    $inputData['vnp_BankCode'] = $vnp_BankCode;
                }
                if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                    $inputData['vnp_Bill_State'] = $vnp_Bill_State;
                }

                //dd($inputData);
                ksort($inputData);
                $query = "";
                $i = 0;
                $hashdata = "";
                foreach ($inputData as $key => $value) {
                    if ($i == 1) {
                        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                    } else {
                        $hashdata .= urlencode($key) . "=" . urlencode($value);
                        $i = 1;
                    }
                    $query .= urlencode($key) . "=" . urlencode($value) . '&';
                }

                $vnp_Url = $vnp_Url . "?" . $query;
                if (isset($vnp_HashSecret)) {
                    $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
                    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
                }
                $returnData = array(
                    'code' => '00'
                    ,
                    'message' => 'success'
                    ,
                    'data' => $vnp_Url
                );
                if (isset($_POST['redirect'])) {
                    header('Location: ' . $vnp_Url);
                    die();
                } else {
                    echo json_encode($returnData);
                }
            } else {
                return redirect()->back();
            }
        }

    }

    public function vnpay_return(Request $request)
    {
        if ($request->vnp_ResponseCode == '00') {
            $transaction = transaction::find($request->vnp_TxnRef);
            //dd($transaction->id);
            // $orders = DB::table('orders')
            //     ->join('products', 'orders.product_id', 'products.id')
            //     ->join('transactions', 'orders.transaction_id', 'transactions.id')
            //     ->where('orders.transaction_id', $transaction->id)
            //     ->get('orders.product_id');
            $order = order::select(order::raw('product_id'))
                ->where('transaction_id', $transaction->id)
                ->get();
            // $products = DB::table('products')
            //     ->join('orders', 'products.id', 'orders.product_id')
            //     ->where('orders.transaction_id', $transaction->id)
            //     ->get('products.quantity');
            $transaction_status = transaction::where('id', $transaction->id)->update(['status' => 'success']);
            $transaction_payment_status = transaction::where('id', $transaction->id)->update(['payment_status' => 'success']);
            foreach ($order as $key => $value) {

                $id_product = $value->product->id;
                $total = DB::table('orders')
                    ->join('products', 'orders.product_id', 'products.id')
                    ->join('transactions', 'orders.transaction_id', 'transactions.id')
                    ->where('orders.product_id', $id_product)
                    ->get('orders.quantity');

                foreach ($total as $totals) {
                    $quantity = $totals->quantity;
                    $newquantity = $value->product->quantity - $quantity;
                    $product = product::where('id', $id_product)->update(['quantity' => $newquantity]);
                }

            }
            Cart::destroy();
            $coupon = session()->get('coupon');
            if ($coupon == true) {
                session()->forget('coupon');
            }
            return redirect()->route('home');
        } else {
            $transaction = transaction::find($request->vnp_TxnRef);
            $orders = DB::table('orders')
                ->join('products', 'orders.product_id', 'products.id')
                ->join('transactions', 'orders.transaction_id', 'transactions.id')
                ->where('orders.transaction_id', $transaction->id)
                ->delete();
            $transaction->delete();
            return redirect()->route('home');
        }
    }

    public function blog()
    {
        return view('layout/blog');
    }

    public function blogDetail()
    {
        return view('layout/blog-detail');
    }

    public function contact()
    {
        return view('layout/contact');
    }

    public function about()
    {
        return view('layout/about/about');
    }

    public function login()
    {
        return view('layout/users/login');
    }

    public function process_login(LoginRequest $request)
    {
        if ($request->isMethod('post')) {
            $email = $request->email;
            $password = $request->password;

            $customer = customer::query()
                ->where('email', $email)
                ->first();
            
                if ($customer) {
                    if (Hash::check($password, $customer->password)) {
                        session()->put('id', $customer->id);
                        session()->put('name', $customer->name);
                        return redirect()->route('home')->with('success', 'Đăng nhập thành công');
                    } else {
                        return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
                    }
                } 
                else{
                    return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
                }
        } 

    }

    public function register()
    {
        return view('layout/users/register');
    }

    public function store(RegisterRequest $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $customer = new customer;
            $customer->name = $data['name'];
            $customer->email = $data['email'];
            $customer->password = Hash::make($data['password']);
            $customer->phone = $data['phone'];
            if ($customer->save()) {
                $to_name = "No reply";
                
                $to_email = $customer->email;//send to this email
                
                $data = array("name"=>"LAKE SHOP", "body" => "Chào mừng bạn đến với LAKE SHOP!", "email" => $to_email); //body of mail.blade.php
                Mail::send('layout.mails.mail-register', $data, function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                        ->subject('Thông tin đăng ký tài khoản tại Lake Shop');
                    $message->from($to_email,$to_name);//send from this mail
                });
                return redirect()->route('login')->with('success', 'Đăng ký thành công');
            } else {
                return redirect()->back()->with('error', 'Đăng ký thất bại');
            }
        }

    }

    public function logout()
    {
        session()->forget('id');
        session()->forget('name');
        return redirect()->route('home');
    }

    public function forgotPassword()
    {
        return view('layout/users/forgot-password');
    }


    //send mail
    // public function send_mail(){
    //     $to_name = "Phú Phạm";
    //     $to_email = "phucaidau117@gmail.com";//send to this email

    //     $data = array("name"=>"LAKE SHOP", "body" => "Chào mừng bạn đến với LAKE SHOP!", "email" => $to_email); //body of mail.blade.php

    //     Mail::send('layout.mails.mail-register', $data, function($message) use ($to_name, $to_email) {
    //         $message->to($to_email, $to_name)
    //                 ->subject('Thông tin đăng ký tài khoản tại Lake Shop');
    //         $message->from($to_email,$to_name);//send from this mail
    //     });
    //     return redirect()->route('home')->with('success', 'Đăng ký thành công');
    // }
}