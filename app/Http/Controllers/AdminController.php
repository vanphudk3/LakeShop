<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\order;
use App\Models\transaction;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use App\Models\admin;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\RegisterRequest;
use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Support\Facades\DB;
use App\Models\product;
use App\Http\Requests\Admin\Products\UpdateRequest;
class AdminController extends Controller
{
    public function index()
    {
        $qty_product = product::count();
        $qty_coupon = coupon::count();
        $paginate = order::count();
        $total_price = transaction::where('status', 'success')->sum('total_price');
        $total_product = product::count();
        $total_customer = order::count();
        return view('admin/index', compact('total_price', 'total_product', 'total_customer', 'paginate', 'qty_product', 'qty_coupon'));
    }

    public function register()
    {
        return view('admin/pages/register');
    }

    public function store(RegisterRequest $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            $admin = new admin;
            $admin->admin_name = $data['admin_name'];
            $admin->admin_username = $data['admin_username'];
            $admin->admin_password = Hash::make($data['admin_password']);
            if($admin->save()){
                return redirect()->route('admin-login')->with('success', 'Đăng ký thành công');
            }
            else{
                return redirect()->back()->with('status', 'Đăng ký thất bại');
            }
        }
    }

    public function login()
    {
        return view('admin/pages/login');
    }

    public function process_login(LoginRequest $request)
    {
        if ($request->isMethod('post')){
            $username = $request->admin_username;
            $password = $request->admin_password;

            $admin = admin::query()
                        ->where('admin_username', $username)
                        ->first();
            if ($admin) {
                if (Hash::check($password, $admin->admin_password)) {
                    session()->put('admin', $admin->admin_name);
                    session()->put('admin_id', $admin->id);
                    return redirect()->route('admin-home')->with('success', 'Đăng nhập thành công');
                } else {
                    return redirect()->back()->with('status', 'Username hoặc Password không chính xác');
                }
            } else {
                return redirect()->back()->with('status', 'Username hoặc Password không chính xác');
            }
        }
    }

    public function logout()
    {
        session()->forget('admin');
        session()->forget('admin_id');
        return redirect()->route('admin-login')->with('success', 'Đăng xuất thành công');
    }

    public function product()
    {
        $qty_product = product::count();
        $qty_coupon = coupon::count();
        $paginate = product::count();
        $one_page = 5;
        $number = ceil($paginate/$one_page);
        //$skip = $one_page * ($page - 1);
        $products = product::orderBy('id', 'desc')->take($one_page)->get();
        //dd ($products);
        foreach ($products as $item){
            if($item->quantity == 0){
                $item->status = 'inactive';
                $item->save();
            }
            else{
                $item->status = 'active';
                $item->save();
            }
        }  
        return view('admin/product',[
            'products' => $products,
            'number' => $number,
            'paginate' => $paginate,
            'qty_product' => $qty_product,
            'qty_coupon' => $qty_coupon,
        ]);
    }

    public function process_page(Request $request){
        $_GET['page'] = $_GET['page'] ?? 1;
        $page = $_GET['page'];
        $qty_product = product::count();
        $qty_coupon = coupon::count();
        $paginate = product::count();
        $one_page = 5;
        $number = ceil($paginate/$one_page);
        switch ($page) {
            case $page > $number:
                $page = $number;
                break;
            case $page < 1:
                $page = 1;
                break;
        }
        $skip = $one_page * ($page - 1);
        $products = product::orderBy('id', 'desc')->skip($skip)->take($one_page)->get();

        // if($page == ){
        //     $products = product::orderBy('id', 'desc')->take(5)->get();
        //     return view('admin/product',[
        //         'products' => $products,
        //         'number' => $number,
        //     ]);
        // }
        // $products = product::orderBy('id', 'desc')->skip(5)->take(5)->get();
        return view('admin/product',[
            'products' => $products,
            'number' => $number,
            'paginate' => $paginate,
            'qty_product' => $qty_product,
            'qty_coupon' => $qty_coupon,
        ]);
         
    }

    public function product_hot(){
        $qty_product = product::count();
        $qty_coupon = coupon::count();
        $paginate = product::count();
        $one_page = 5;
        $number = ceil($paginate/$one_page);
        $product = DB::table('orders')
                    ->join('products', 'orders.product_id', 'products.id')
                    ->select(DB::raw('sum(orders.quantity) as total'), 'orders.product_id', 'products.name', 'products.image', 'products.price', 'products.quantity', 'products.status', 'products.created_at')
                    ->groupBy('orders.product_id', 'products.name', 'products.image', 'products.price', 'products.quantity', 'products.status', 'products.created_at')
                    ->orderByRaw('total DESC')
                    ->take($one_page)
                    ->get();
        return view('admin/products/product-hot',[
            'product' => $product,
            'number' => $number,
            'paginate' => $paginate,
            'qty_product' => $qty_product,
            'qty_coupon' => $qty_coupon,
        ]);
    }

    public function process_page_product_hot(Request $request){
        $_GET['page'] = $_GET['page'] ?? 1;
        $page = $_GET['page'];
        $qty_product = product::count();
        $qty_coupon = coupon::count();
        $paginate = product::count();
        $one_page = 5;
        $number = ceil($paginate/$one_page);
        switch ($page) {
            case $page > $number:
                $page = $number;
                break;
            case $page < 1:
                $page = 1;
                break;
        }
        $skip = $one_page * ($page - 1);
        $product = DB::table('orders')
                    ->join('products', 'orders.product_id', 'products.id')
                    ->select(DB::raw('sum(orders.quantity) as total'), 'orders.product_id', 'products.name', 'products.image', 'products.price', 'products.quantity', 'products.status', 'products.created_at')
                    ->groupBy('orders.product_id', 'products.name', 'products.image', 'products.price', 'products.quantity', 'products.status', 'products.created_at')
                    ->orderByRaw('total DESC')
                    ->skip($skip)
                    ->take($one_page)
                    ->get();
        return view('admin/products/product-hot',[
            'product' => $product,
            'number' => $number,
            'paginate' => $paginate,
            'qty_product' => $qty_product,
            'qty_coupon' => $qty_coupon,
        ]);
    }

    public function product_soldout(){
        $products = DB::table('products')
                    ->where('quantity',0)
                    ->get();
        return view('admin/products/product_soldout',[
            'products' => $products
        ]);
    }

    public function productAdd()
    {
        return view('admin/products/product-add');
    }

    public function productStore(UpdateRequest $request){
        if($request->isMethod('post')){
            $data = $request->all();
            if($request->hasFile('image')){
                $destinationPath = public_path('images/home');
                $image = $request->file('image'); 
                $image_name = $image->getClientOriginalName();
                $image->move($destinationPath, $image_name);
                $data['image'] = $image_name;
            }
            $product = new product;
            $product->name = $data['name'];
            $product->price = $data['price'];
            $product->description = $data['description'];
            $product->special = $data['special'];
            $product->preserve = $data['preserve'];
            $product->image = $data['image'];
            $product->quantity = $data['quantity'];
            $product->discount = $data['discount'];
            $product->status = $data['status'];
            if($product->save()){
                return redirect()->route('admin-product')->with('success', 'Thêm sản phẩm thành công');
            }
            else{
                return redirect()->back()->with('status', 'Thêm sản phẩm thất bại');
            }
        }
    }

    public function productEdit(product $product)
    {
        $products = product::find($product);
        $image_old = $product->image;
        return view('admin.products.product-edit', compact('product', 'image_old'));
    }

    public function productUpdate(Request $request,product $product){
        $product->fill($request->except('_token'));
        if($request->hasFile('image')){
            $destinationPath = public_path('images/home');
            $image = $request->file('image'); 
            $image_name = $image->getClientOriginalName();
            $image->move($destinationPath, $image_name);
            $product['image'] = $image_name;
        }
        else{
            $product['image'] = $request->images;
        }
        //dd($product);
        $product->save();
        return redirect()->route('admin-product')->with('success', 'Cập nhật sản phẩm thành công');
    }

    public function productDelete(product $product)
    {
        $product->delete();
        return redirect()->route('admin-product')->with('success', 'Xóa sản phẩm thành công');
    }

    public function insert_coupon(){
        return view('admin/coupon/insert-coupon');
    }
    public function store_coupon(Request $request){
        $data = $request->all();
        $coupon = new Coupon;
        $coupon->name = $data['name'];
        $coupon->code = $data['code'];
        $coupon->discount = $data['discount'];
        $coupon->value = $data['value'];
        $coupon->quantity = $data['quantity'];
        $coupon->status = $data['status'];
        $coupon->save();
        return redirect()->route('admin-list-coupon')->with('success', 'Thêm mã giảm giá thành công');
    }
    public function list_coupon(){
        $qty_product = product::count();
        $qty_coupon = coupon::count();
        $paginate = order::count();
        $coupon = Coupon::orderBy('id','DESC')->get();
        return view('admin/coupons',compact('coupon','paginate','qty_product','qty_coupon'));
    }

    public function delete_coupon($coupon){
        $coupon = Coupon::find($coupon);
        $coupon->delete();
        return redirect()->back()->with('success', 'Xóa mã giảm giá thành công');
    }

    public function charts()
    {
        return view('admin/charts');
    }

    public function user()
    {
        return view('admin/user');
    }

    public function userAdd()
    {
        return view('admin/user-add');
    }

    public function userEdit()
    {
        return view('admin/user-edit');
    }

    public function userDelete()
    {
        return view('admin/user-delete');
    }

    public function order()
    {
        $qty_product = product::count();
        $qty_coupon = coupon::count();
        $paginate = order::count();
        $one_page = 5;
        $number = ceil($paginate/$one_page);
        $transaction = transaction::orderBy('id','DESC')->take($one_page)->get();
        return view('admin/order',[
            'transaction' => $transaction,
            'number' => $number,
            'paginate' => $paginate,
            'qty_product' => $qty_product,
            'qty_coupon' => $qty_coupon,
        ]);
    }

    public function process_page_order(Request $request){
        $_GET['page'] = $_GET['page'] ?? 1;
        $page = $_GET['page'];
        $qty_product = product::count();
        $qty_coupon = coupon::count();
        $paginate = order::count();
        $one_page = 5;
        $number = ceil($paginate/$one_page);
        switch ($page) {
            case $page > $number:
                $page = $number;
                break;
            case $page < 1:
                $page = 1;
                break;
        }
        $skip = $one_page * ($page - 1);
        $transaction = transaction::orderBy('id','DESC')->skip($skip)->take($one_page)->get();
        return view('admin/order',[
            'transaction' => $transaction,
            'number' => $number,
            'paginate' => $paginate,
            'qty_product' => $qty_product,
            'qty_coupon' => $qty_coupon,
        ]);
    }

    public function orderDetail($id){
        $qty_product = product::count();
        $qty_coupon = coupon::count();
        $paginate = order::count();
        $transaction = transaction::find($id);
        $order = DB::table('orders')
        ->join('transactions','orders.transaction_id','transactions.id')
        ->join('sizes','orders.size_id','sizes.id')
        ->select('sizes.size','transactions.id','orders.quantity','orders.created_at')
        ->where('orders.transaction_id',$id)
        ->get();

        $product = DB::table('orders')
        ->join('products','orders.product_id','products.id')
        ->join('transactions','orders.transaction_id','transactions.id')
        ->join('sizes','orders.size_id','sizes.id')
        ->select('products.id','products.name','products.image','products.price','orders.quantity','sizes.size')
        ->where('orders.transaction_id',$id)
        ->get();
        
        return view('admin/order/order-detail',compact('transaction','order','product','paginate','qty_product','qty_coupon'));
    }

    public function orderDetailUpdate($id){
        
        $orders = DB::table('orders')
            ->join('products','orders.product_id','products.id')
            ->join('transactions','orders.transaction_id','transactions.id')
            ->where('orders.transaction_id',$id)
            ->get('orders.product_id');
        $order = order::select(order::raw('product_id'))
            ->where('transaction_id',$id)
            ->get();
        $products = DB::table('products')
            ->join('orders','products.id','orders.product_id')
            ->where('orders.transaction_id',$id)
            ->get('products.quantity');
        $transaction = transaction::where('id',$id)->update(['status' => 'success']);
        foreach($order as $key => $value){
           
            $id_product = $value->product->id;
            $total =DB::table('orders') 
                ->join('products','orders.product_id','products.id')
                ->join('transactions','orders.transaction_id','transactions.id')
                ->where('orders.product_id',$id_product)
                ->get('orders.quantity');
                
            foreach($total as $totals){
                $quantity = $totals->quantity;
                $newquantity = $value->product->quantity - $quantity;
                $product = product::where('id',$id_product)->update(['quantity' => $newquantity]);
            }
        }
        return redirect()->route('admin-order')->with('success', 'Cập nhật đơn hàng '.$id.' thành công');
    }

    public function orderAdd()
    {
        return view('admin/order-add');
    }

    public function orderEdit()
    {
        return view('admin/order-edit');
    }

    public function orderDelete(request $id)
    {
        //dd($id->id);
        $order = order::where('transaction_id',$id->id)->delete();
        $transaction = transaction::find($id->id)->delete();
        return response()->json([
            'success' => 'Xóa đơn hàng thành công',
            'status' => true
        ]);
    }

    public function search(Request $request){
        $search = $request->search;
        $paginate = order::count();
        $one_page = 5;
        $number = ceil($paginate/$one_page);
        $transaction = transaction::where('id','like','%'.$search.'%')->orderBy('id','DESC')->take($one_page)->get();
        if(empty($transaction)){
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy đơn hàng',
            ]);
        }
        $html = view('admin/order/orderAjax',[
            'transaction' => $transaction,

        ])->render();

        return response()->json([
            'html' => $html,
        ]);
    }

    public function error404(){
        return view('admin/pages/404');
    }
}
