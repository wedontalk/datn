<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\qlsanpham\qlsanphamInterface;
use Illuminate\Support\Facades\View;
use App\Models\thanhpho;
use App\Models\quanhuyen;
use App\Models\xaphuong;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\coupon;
// use Illuminate\Support\Facades\Mail;
use App\Mail\DatHang;
use Mail;

session_start();

class HomeController extends Controller
{
    protected $products;
    public function __construct(qlsanphamInterface $products)
    {
        $this->products = $products;
       
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       $products= $this-> products ->getAll();
       $categoryNav = DB::Table('nav_menu')->orderby('id')->get();
       return view('Site.index',compact('products','categoryNav'));

       return view('Site.index',compact('products'));
    }
    public function dichvu(){
        return view('site.checkout');
    }

    public function productDetail($slug)
    {   
        $categoryNav = DB::Table('categories')->orderby('id')->get();
         $detail_product = DB::table('information_post')
         ->join('categories','id_category','information_post.id_category')
         ->where('slug_product',$slug)->get();
       return view('Site.productDetail',compact('detail_product','categoryNav'));
        

    }
    public function products()
    {
        $categoryNav = DB::Table('nav_menu')->orderby('id')->get();
       $products= $this->products->getAll();
       $category_by_id = DB::table('categories')->get();
       return view('Site.products',compact('products','categoryNav','category_by_id'));
    }

    // public function productDetail()
    // {
    //    return view('Site.productDetail');
    // }

    // public function products()
    // {
    //    $products= $this-> products ->getAll();
       
    //    return view('Site.products',compact('products'));

    // }
    function addToCart($id){
        // session()->flush('carts');
        $product = $this-> products->find($id);
        $carts= session()->get('cart',[]);
        if(isset($carts[$id])){
            $carts[$id]['quantity']=$carts[$id]['quantity']+1;
        }else{
            $carts[$id]=[
                'name'=>$product->title,
                'price'=>$product->price,
                'quantity'=>1,
                'images'=>$product->image,
                
            ];
        }
        session()->put('cart', $carts);
        $carts =session()->get('cart');
        $cart=View('Site.cartquick',compact('carts'))->render();
        return response()->json(['cartquick'=> $cart]);
        // echo "<pre>";
        // print_r(session()->get('cart'));
        // return response()->json([
        //     'code'=>200,
        //     'message'=>'success'

        // ], 200);
        
    }

    public function cartViews(){
        $carts= session()->get('cart');
        return view("site.cartView",compact('carts'));
    }
    public function updateCart(Request $request){
        // dd($request->all());
        if($request->id && $request ->quantity){
            $carts =session()->get('cart');
            $carts[$request->id]['quantity']=$request->quantity;
            session()->put('cart',$carts);
            $carts =session()->get('cart');
            $cartt=View('Site.cartquick',compact('carts'))->render();
            $cart=View('Site.contentCart',compact('carts'))->render();
            return response()->json(['contentCart'=> $cart,'cartquick'=> $cartt]);
        } 
    }
    public function deleteCart(Request $request){
        if($request->id){
            $carts =session()->get('cart');
            unset($carts[$request->id]);
            session()->put('cart',$carts);
            $carts =session()->get('cart');
            $cart=View('Site.contentCart',compact('carts'))->render();
            $cartt=View('Site.cartquick',compact('carts'))->render();
            return response()->json(['contentCart'=> $cart,'cartquick'=> $cartt]);
            
        } 
    }
    public function removeCart(){
        session()->flush('carts');
        session()->flush('coupon');
        $carts =session()->get('cart');
        $cart=View('Site.contentCart',compact('carts'))->render();
        $cartt=View('Site.cartquick',compact('carts'))->render();
        return response()->json(['contentCart'=> $cart,'cartquick'=> $cartt]);
    } 
    public function checkout(){
        $carts =session()->get('cart');
        $thanhpho = thanhpho::orderBy('matp', 'ASC')->get();
        $quanhuyen = quanhuyen::orderBy('id', 'ASC')->get();
        $xaphuong = xaphuong::orderBy('id', 'ASC')->get();
        return view('site.checkout',compact('thanhpho','xaphuong','quanhuyen','carts'));

    } 
    public function select_thanhpho(Request $request){
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == "city") {
                $select_province = quanhuyen::where('matp', $data['ma_id'])->orderby('id', 'ASC')->get();
                $output .= '<option>-----Chọn quận huyện-----</option>';
                foreach ($select_province as $key => $province) {

                    $output .= '<option value="' . $province->id . '">' . $province->name_quanhuyen . '</option>';
                }
            } else {
                $select_wards = xaphuong::where('maqh', $data['ma_id'])->orderby('id', 'ASC')->get();
                $output .= '<option>-----Chọn xã phường-----</option>';
                foreach ($select_wards as $key => $ward) {
                    $output .= '<option value="' . $ward->id . '">' . $ward->name_xaphuong . '</option>';
                }
            }
            echo $output;
        }
    }
    public function save_checkout( Request $request){
        //insert order_product
        // $dataaaa= $request->except("_token","peyment");
        $id = Auth::user()->id;
        $email = Auth::user()->email;
        $name = Auth::user()->name;
        $phone = Auth::user()->phone;

        // $dataaaa['id_user']=Auth::user()->id;

        
        // session()->get(['use'=>$dataaaa]);
        if ($request->phuongthuc_thanhtoan==2) {
            // $us=['id'=>$id];
            
            $data= array();
            $data['id_user']= $id;
            $data['order_name']=$request->order_name;
            $data['order_email']=$email;
            $data['id_thanhpho']=$request->id_thanhpho;
            $data['id_quanhuyen']=$request->id_quanhuyen;
            $data['id_xaphuong']=$request->id_xaphuong;
            $data['order_phone']=$request->order_phone;
            $data['phuongthuc_thanhtoan']=$request->phuongthuc_thanhtoan;
            $data['phuongthuc_giaohang']=$request->phuongthuc_giaohang;
            $data['order_note']=$request->order_note;
            $data['order_address']=$request->order_address;
            $data['order_code']=\Carbon\Carbon::now('Asia/Ho_Chi_Minh')->timestamp;
            $data['id_status']=1;
            $data_id=DB::table('order_product')->insertGetId($data);
            
            
        //insert order_detail
        $carts= session()->get('cart');
        foreach( $carts as $item){
            $cart['order_id']=$data_id;
            $cart['product_name']=$item['name'];
            $cart['product_price']=$item['price'];
            $cart['product_quantity']=$item['quantity'];
            $cart['tong_tien']=$request->tong_tien;
            DB::table('order_detail')->insertGetId($cart);
        }
        $total= $request->tong_tien;
        // return $this->return($request,$data,$cart);
            return view('Vnpay.index',compact('total','dataaaa'));
        }else{
        $data= array();
        $data['id_user']=$id;
        $data['order_name']=$request->order_name;
        $data['order_email']=$email;
        $data['id_thanhpho']=$request->id_thanhpho;
        $data['id_quanhuyen']=$request->id_quanhuyen;
        $data['id_xaphuong']=$request->id_xaphuong;
        $data['order_phone']=$request->order_phone;
        $data['phuongthuc_thanhtoan']=$request->phuongthuc_thanhtoan;
        $data['phuongthuc_giaohang']=$request->phuongthuc_giaohang;
        $data['order_note']=$request->order_note;
        $data['order_address']=$request->order_address;
        $data['order_code']=\Carbon\Carbon::now('Asia/Ho_Chi_Minh')->timestamp;
        $data_id=DB::table('order_product')->insertGetId($data);

        //insert order_detail
        $carts= session()->get('cart');
        foreach( $carts as $item){
            $cart['order_id']=$data_id;
            $cart['product_name']=$item['name'];
            $cart['product_price']=$item['price'];
            $cart['product_quantity']=$item['quantity'];
            $cart['tong_tien']=$request->tong_tien;
            DB::table('order_detail')->insertGetId($cart);
        }
            // Session()->forget('cart');
        $now =Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail="Đơn mua hàng ngày".' '.$now;

        //lấy cart
        if(Session::get('cart')==true){
            foreach(Session::get('cart') as $key => $cart_mail){
                $cart_array[]=array(
                    'name'=> $cart_mail['name'],
                    'price'=>$cart_mail['price'],
                    'quantity'=>$cart_mail['quantity'],
                    'tong'=>$request->tong_tien,
                );
            }

           
        }
        Mail::send('mail.confirm',[
            'cart_array'=>$cart_array,
            'order_code'=>$data['order_code'],
            'name'=>$name,
            'email'=>$email,
            'phone'=>$phone,
            'address'=>$data['order_address'],
            'order_note'=>$data['order_note'],
            'thanhpho'=> thanhpho::where('matp', $data['id_thanhpho'])->get(),
            'quanhuyen'=> quanhuyen::where('id', $data['id_quanhuyen'])->get(),
            'xaphuong'=> xaphuong::where('id', $data['id_xaphuong'])->get(),
            'email'=>$email,
        ],function($message)use($email,$name,$title_mail){
            $message->to($email,$name)->subject($title_mail);
            $message->from('hieuhaohoa201@gmail.com');
        });
        // session::forget('cart');
        session::forget('coupon');
        

    }
        return Redirect::to('/');
    }
        
    public function createpayment(Request $request)
    {
        session(['cost_id' => $request->id]);
        session(['url_prev' => url()->previous()]);
        $vnp_TmnCode = "UDOPNWS1"; //Mã website tại VNPAY 
        $vnp_HashSecret = "EBAHADUGCOEWYXCMYZRMTMLSHGKNRPBN"; //Chuỗi bí mật
        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:8000/return-vnpay";
        $vnp_TxnRef = date("YmdHis"); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toán hóa đơn phí dich vụ";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $request->input('amount') * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();

        $inputData = array(
            "vnp_Version" => "2.0.0",
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
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
           // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
            $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        return redirect($vnp_Url);
    }

    public function return(Request $request){   
        
        if($request->vnp_ResponseCode == "00") {
            // $this->apSer->thanhtoanonline(session('cost_id'));
        DB::beginTransaction();      
        $ad=$request->vnp_TxnRef;
        $d=session()->get('use');

            $url = session('url_prev','/');
        $vnpay=$request->all();
            dd($d);
        $data_payment=array();
        $data_payment['order_id']=$vnpay['vnp_TxnRef'];
        $data_payment['thanh_vien']= $da['id_user'];
        $data_payment['money']=$vnpay['vnp_Amount'];
        $data_payment['note']=$vnpay['vnp_OrderInfo'];
        $data_payment['vnp_response_code']=$vnpay['vnp_ResponseCode'];
        $data_payment['code_vnpay']=$vnpay['vnp_TransactionNo'];
        $data_payment['code_bank']=$vnpay['vnp_BankCode'];
        $data_payment['time']=date('Y-m-d H:i',strtotime($vnpay['vnp_PayDate']));
        
        DB::table('payments')->insertGetId($data_payment);

                    return view('Vnpay.vnpay_return',compact('vnpay'));
            // return redirect($url)->with('success' ,'Đã thanh toán phí dịch vụ');
        
    }
    // session()->forget('url_prev');
    // return redirect($url)->with('errors' ,'Lỗi trong quá trình thanh toán phí dịch vụ');

    }
    public function check_coupon(Request $request){
        $data = $request->all();
        $coupon = Coupon::where('coupon_code',$data['coupon'])->first();
        if($coupon){
            $count_coupon = $coupon->count();
            if($count_coupon>0){
                $coupon_session = Session::get('coupon');
                if($coupon_session==true){
                    $is_avaiable = 0;
                    if($is_avaiable==0){
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,

                        );
                        Session::put('coupon',$cou);
                    }
                }else{
                    $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,

                        );
                    Session::put('coupon',$cou);
                }
                Session::save();
                return redirect()->back()->with('message','Thêm mã giảm giá thành công');
            }

        }else{
            return redirect()->back()->with('error','Mã giảm giá không đúng');
        }
    }  
    public function unset_coupon(){
        $coupon =session()->get('coupon');
        if($coupon=true){
            session::forget('coupon');
            return redirect()->back()->with('message',' Xóa Mã giảm thành công!');
            
        } 
    } 
}

