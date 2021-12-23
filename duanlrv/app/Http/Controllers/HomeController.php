<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\coso;
use App\Models\orderDetail;
use App\Models\navmenu;
use App\Models\rating;
use App\Models\datlich;
use App\Models\donhang;
use App\Models\dichvucoso;
use App\Models\information;
use App\Models\category;
use App\Models\news;
use App\Models\Comment;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\qlsanpham\qlsanphamInterface;
use Illuminate\Support\Facades\View;
use App\Models\thanhpho;
use App\Models\quanhuyen;
use App\Models\xaphuong;
use App\Models\nhanvien;
// use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\coupon;
// use Illuminate\Support\Facades\Mail;
use App\Mail\DatHang;
use Mail;
use Auth;
use App\Http\Requests\thanhtoan;
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

        $categoryNav = information::where('slug_product', $slug)->first();
        information::where('id',$categoryNav->id)->increment('view');
        $detail_product = information::orderBy('id')->where('id',$categoryNav->id)->where('id_status', 1)->get();
        $danhmuc = navmenu::orderBy('id','ASC')->where('hidden', 1)->get();
        $ratingAVG = rating::where('product_id',$categoryNav->slug_product)->avg('rating_star');
        $comment = Comment::get();
        $new_product = information::take(4)->get();
       return view('Site.productDetail',compact('detail_product','categoryNav','danhmuc','ratingAVG','comment','new_product'));

    }
    public function products()
    {
        $categoryNav = DB::Table('nav_menu')->orderby('id')->get();
        $products= information::orderBy('id')->where('id_status', 1)->search()->paginate(9);
        $category_by_id = DB::table('categories')->get();
        foreach($category_by_id as $key => $cate) {
            $cate_id = $cate->id;
        

            if(isset($_GET['locsp'])){
                $sort_by = $_GET['locsp'];


                if($sort_by == $cate->slug){
                    $products = information::with('phansanpham')->where('id_category', $cate_id)->orderBy('id', 'ASC')->search()->paginate(10);
                    $products->render();
                }
            }
        }
        return view('Site.products',compact('products','categoryNav','category_by_id'));

       
    }
    public function binh_luan(Request $request ,$slug){
        $data = array();
        $data['comment'] = $request->content;
        $data['comment_product_id'] =$slug;
        $data['comment_name'] =Auth::user()->name;
        $data['comment_iduser'] =Auth::user()->id;
        DB::table('comment')->insert($data);
        return redirect()->back();
    }
    public function delete_comment($id){
        DB::table('comment')->where('comment_id',$id)->delete();
        return redirect()->back();
    }

    public function blog(){
        $blog =news::orderBy('id','ASC')->where('hidden', 1)->search()->paginate(6);
        $baidang =news::orderBy('id','desc')->where('hidden', 1)->search()->paginate(4);
        return view('Site.blog',compact('blog','baidang'));
    }
    public function news($slug){
        $news =news::orderBy('id','ASC')->where('hidden', 1)->where('slug',$slug)->get();
        return view('Site.blogDetail',compact('news'));
    }

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
                'tonkho'=>$product->quantity,
                
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
        $carts =session()->get('cart');
        //kiểm tra số lượng cập nhật có hợp lệ không
        if($request->id && $request->quantity <= $carts[$request->id]['tonkho']){   
            $carts[$request->id]['quantity']=$request->quantity;
            session()->put('cart',$carts);
            $carts =session()->get('cart');
            $cartt=View('Site.cartquick',compact('carts'))->render();
            $cart=View('Site.contentCart',compact('carts'))->render();
            return response()->json([
                'code'=>'200',
                'message'=>'cập nhật thành công!',
                'contentCart'=> $cart,
                'cartquick'=> $cartt,
            ],200
            );
        }else{
            $carts =session()->get('cart');
            $cartt=View('Site.cartquick',compact('carts'))->render();
            $cart=View('Site.contentCart',compact('carts'))->render();
            return response()->json([
                'code'=>'404',
                'message'=>'cập nhật thất bại!',
                'contentCart'=> $cart,
                'cartquick'=> $cartt,
            ],200
            );
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
            // return response()->json(['contentCart'=> $cart,'cartquick'=> $cartt]);
            return response()->json([
                'code'=>'200',
                'message'=>'xóa thành công!',
                'contentCart'=> $cart,
                'cartquick'=> $cartt,
            ],200
            );
        } 
    }
    public function removeCart(){
        session()->flush('carts');
        session()->flush('coupon');
        $carts =session()->get('cart');
        $cart=View('Site.contentCart',compact('carts'))->render();
        $cartt=View('Site.cartquick',compact('carts'))->render();
        // return response()->json(['contentCart'=> $cart,'cartquick'=> $cartt]);
        return response()->json([
            'code'=>'200',
            'message'=>'cập nhật thành công!',
            'contentCart'=> $cart,
            'cartquick'=> $cartt,
        ],200
        );
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
                $output .= '<option  value="">-----Chọn quận huyện-----</option>';
                foreach ($select_province as $key => $province) {

                    $output .= '<option value="' . $province->id . '">' . $province->name_quanhuyen . '</option>';
                }
            } else {
                $select_wards = xaphuong::where('maqh', $data['ma_id'])->orderby('id', 'ASC')->get();
                $output .= '<option  value="">-----Chọn xã phường-----</option>';
                foreach ($select_wards as $key => $ward) {
                    $output .= '<option value="' . $ward->id . '">' . $ward->name_xaphuong . '</option>';
                }
            }
            echo $output;
        }
    }


    public function save_checkout( thanhtoan $request){
        
        //insert order_product

        $id = \Auth::user()->id;

        $email = $request->order_email;
        $name = \Auth::user()->name;
        $phone = \Auth::user()->phone;


        if ($request->phuongthuc_thanhtoan==2) {
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

            return view('Vnpay.index',compact('total','data'));

        }else{
            //nếu có mã coupon -> giảm số lượng coupon
            $coupon=Session::get('coupon',[]);
            if($coupon){
                // $cou=$coupon['coupon_qty'];
                foreach($coupon as $cou){
                    $coupon_id=$cou['id_coupon'];
                    $count_coupon=$cou['coupon_qty']-1;
                }
                // dd($coupon);
                DB::table('coupon')->where('id',$coupon_id)->update(array('id'=>$coupon_id,'coupon_qty'=>$count_coupon));
            }else{
            }
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
        ],function($message)use($email,$name,$title_mail){
            $message->to($email,$name)->subject($title_mail);
            $message->from('hieuhaohoa201@gmail.com');
        });
        session::forget('cart');
        session::forget('coupon');
    }
        return view('site.successOrder');
    }



    public function addtoWishlist($id){
        // session()->flush('carts');
        $product = $this-> products->find($id);
        $Wishlists= session()->get('Wishlists',[]);
            $Wishlists[$id]=[
                'name'=>$product->title,
                'price'=>$product->price,
                'images'=>$product->image,
            ];
        session()->put('Wishlists', $Wishlists);
        $Wishlists =session()->get('Wishlists');
        return redirect()->back();
        // echo "<pre>";
        // print_r(session()->get('Wishlists'));
        // print_r(count(session()->get('Wishlists')));
        // return response()->json([
        //     'code'=>200,
        //     'message'=>'success'

        // ], 200);

        
    }

    public function deleteWishlist(Request $request){
        if($request->id){
            $Wishlists =session()->get('Wishlists');
            unset($Wishlists[$request->id]);
            session()->put('Wishlists',$Wishlists);
            $Wishlists =session()->get('Wishlists');
            
            // $Wishlist=View('site.contentWishlist',compact('wishlist'))->render();
            // return response()->json(['contentWishlist'=> $Wishlist]);
        } 
     
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

    
    
    public function calendar(){
        $CS = coso::all();
        $DV = dichvucoso::all();
        return view("site.calendar",['CS'=>$CS],['DV'=>$DV]);
    }

    public function search_calendar(Request $request){
        $data = $request->all();
        $output = '';
        if($data['action']){
            $id = datlich::where('ID_KHDL',$data['key'])->first();
            if($data['action']=='search'){
                // $search = datlich::find($id);
                if($data['key'] == $id['ID_KHDL']&&$data['key']!=''){
                    $output = '<div class="row form-group">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <p> <strong> Họ Và Tên: </strong><span > ' . $id->name . '</span></p>
                            </div><!-- /input-group -->
                        </div><!-- /.col-lg-6 -->
                        <div class="col-lg-6 ">
                            <div class="input-group">
                                <p><strong>Email: </strong><span >' . $id->email . ' </span></p>
                            </div><!-- /input-group -->
                        </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->
                    <div class="row form-group">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <p><strong>Số Điện Thoại: </strong><span >' . $id->phone . ' </span></p>
                            </div><!-- /input-group -->
                        </div><!-- /.col-lg-6 -->
                        <div class="col-lg-6 ">
                            <div class="input-group">
                                <p><strong>Địa Chỉ: </strong><span >' . $id->address . ' </span></p>
                            </div><!-- /input-group -->
                        </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->
                    <div class="row form-group">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <p><strong>Cơ Sở: </strong><span > ' . $id->id_coso . '</span></p>
                            </div><!-- /input-group -->
                        </div><!-- /.col-lg-6 -->
                        <div class="col-lg-6 ">
                            <div class="input-group">
                                <p><strong>Dịch Vụ:</strong> <span>' . $id->id_nhucau . ' </span></p>
                            </div><!-- /input-group -->
                        </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->
                    <div class="row form-group">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <p><strong>Ngày: </strong><span > ' . $id->date . '</span></p>
                            </div><!-- /input-group -->
                        </div><!-- /.col-lg-6 -->
                        <div class="col-lg-6 ">
                            <div class="input-group">
                                <p><strong>Thời Gian: </strong><span>' . $id->hour . '</span></p>
                            </div><!-- /input-group -->
                        </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->

                    <div class="form-group">
                        <p><strong>Ghi Chú: </strong><span id="ghichu" style="width: 100%;"> </span></p>
                    </div>';
                    echo $output;
                }     
            }
        }
        
    }
    public function error_search(Request $request){
        $data = $request->all();
        $output = '';
        if($data['action']){
            if($data['action']=='search'){
                if($data['key']==''||$data['key']==null){
                    $output = '<p>KHÔNG HỢP LỆ</p>';
                    return $output;
                }   
            }
        }
    }

    public function select_DV(Request $request){
        $data = $request->all();
        
        if ($data['action']) {
            $output = '';
            if ($data['action'] == "CS") {
                $select_DV = dichvucoso::all();
                $output .= '<option>-----Chọn Dịch Vụ-----</option>';
                foreach ($select_DV as $key => $DV) {
                    $output .= '<option value="' . $DV->name_dichvu . '">' . $DV->name_dichvu . '</option>';
                }
            } else {
            }
            echo $output;
        }
        
    }
    
    public function Addcalendar(Request $req){
        $data = new datlich();
        $data->name = $req->name;
        $data->phone = $req->phone;
        $data->email = $req->email;
        $data->id_user = $req->id_user;
        $data->address = $req->address;
        $data->ghichu = $req->ghichu;
        $data->id_coso = $req->CS;
        $data->id_nhucau = $req->DV;
        $data->date = $req->date;
        $data->hour = $req->hour;
        $data->id_KHDL = $req->id_KHDL;
        $data->save();
        $now =Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $title_mail="Đặt lịch thành công!".' '.$now;
        $email=$req->email;
        $name=$req->name;
        Mail::send('Mail.Datlich',[
            'name'=>$data->name,
            'email'=>$data->email,
            'phone'=>$data->phone,
            'address'=>$data->address,
            'coso'=>$data->id_coso,
            'nhucau'=>$data->id_nhucau,
            'date'=>$data->date,
            'time'=>$data->hour,
            'note'=>$data->ghichu,
        ],function($message)use($email,$name,$title_mail){
            $message->to($email,$name)->subject($title_mail);
            $message->from('ttpetshopvn@gmail.com');
        });
        return view('site.successOrder');

    }
    // session()->forget('url_prev');
    // return redirect($url)->with('errors' ,'Lỗi trong quá trình thanh toán phí dịch vụ');


    public function check_coupon(Request $request){
        $data = $request->all();
        $now =Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $coupon = Coupon::where('coupon_code',$data['coupon'])->first();
        if($coupon){
            $count_coupon = $coupon['coupon_qty'];
            if($count_coupon > 0 && strtotime($coupon['coupon_date_end']) > strtotime($now)){



   
                $coupon_session = Session::get('coupon');
                if($coupon_session==true){
                    $is_avaiable = 0;
                    if($is_avaiable==0){
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,

                            'coupon_qty'=>$coupon->coupon_qty,
                            'id_coupon'=>$coupon->id,

                        );
                        Session::put('coupon',$cou);
                    }
                }else{
                    $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,
                            'coupon_qty'=>$coupon->coupon_qty,
                            'id_coupon'=>$coupon->id,

                        );
                    Session::put('coupon',$cou);
                }
                Session::save();
                return redirect()->back()->with('message','Thêm mã giảm giá thành công');
            }else  {
                return redirect()->back()->with('error','Mã giảm giá đã hết hạn!');
            }

        }else {
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
    public function search(Request $request){
        $keyword= $request->keyword;
        $categoryNav = DB::Table('nav_menu')->orderby('id')->get();
        $category_by_id = DB::table('categories')->get();
        $products= DB::Table('information_post')->where('title','like','%'.$keyword.'%')->get();
        return view('Site.products',compact('products','categoryNav','category_by_id'));
    }
    public function locgiasp()
    {
        $minprice=$_GET['minamount'];
        $maxprice=$_GET['maxamount'];
       $products= DB::Table('information_post')->whereBetween('discount',[$minprice,$maxprice])->orderBy('id','ASC')->get();
       $categoryNav = DB::Table('nav_menu')->orderby('id')->get();
       $category_by_id = DB::table('categories')->get();
       return view('Site.products',compact('categoryNav','category_by_id','products'));
    //    return view('Site.products',compact('products','categoryNav','category_by_id','product_loc'));

    } 



 

    public function return(Request $request){   
            
            if($request->vnp_ResponseCode == "00") {
                // $this->apSer->thanhtoanonline(session('cost_id'));
            DB::beginTransaction();      
            $ad=$request->vnp_TxnRef;
            $d=session()->get('use');

                $url = session('url_prev','/');
            $vnpay=$request->all();
            $data_payment=array();
            $data_payment['order_id']=$vnpay['vnp_TxnRef'];
            // $data_payment['thanh_vien']= $da['id_user'];
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
    }

public function loi()
{
    return view('layouts.404');
}

public function lichsudonhang()
{
    $data = datlich::orderBy('id', 'desc')->where('id_user', Auth::user()->id)->search()->paginate(6);
    $donhang = donhang::orderBy('order_id', 'desc')
    ->where('id_user', Auth::user()->id)->search()->paginate(6);
    return view('site.lichsudh', compact('donhang','data'));
}
public function donhangdatlich(Request $request){
    $data = datlich::orderBy('id', 'desc')->where('id_user', Auth::user()->id)->search()->paginate(6);
    $donhang = donhang::orderBy('order_id', 'desc')->where('id_user', Auth::user()->id)->search()->paginate(6);
    return view('site.profile', compact('data','donhang'));
}

public function updatelichdat(Request $request){
    $donlich = datlich::orderBy('id', 'desc')->get();
    $id = $request->idhuy;
    $data = $request->all();
    if($data['status'] == 2 ){
    $update = datlich::find($id);
    $update->id_status = 3;
    $update->save();
    echo 'done';
    }
    echo 'loi';
}



}

