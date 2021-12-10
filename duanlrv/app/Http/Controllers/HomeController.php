<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Models\coso;
use App\Models\navmenu;
use App\Models\rating;
use App\Models\datlich;
use App\Models\dichvucoso;
use App\Models\information;
use App\Models\category;
use App\Models\news;
use App\Models\Comment;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\qlsanpham\qlsanphamInterface;
use Illuminate\Support\Facades\View;
use SebastianBergmann\Environment\Console;

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
        $detail_product = information::orderBy('id')->where('id',$categoryNav->id)->where('id_status', 1)->get();
        $danhmuc = navmenu::orderBy('id','ASC')->where('hidden', 1)->get();
        $ratingAVG = rating::where('product_id',$slug)->avg('rating_star');
        $comment = Comment::get();
       return view('Site.productDetail',compact('detail_product','categoryNav','danhmuc','ratingAVG','comment'));
    }
    public function products()
    {
        $categoryNav = DB::Table('nav_menu')->orderby('id')->get();
       $products= $this->products->getAll();
       $category_by_id = DB::table('categories')->get();
       return view('Site.products',compact('products','categoryNav','category_by_id'));
    }
    public function binh_luan(Request $request ,$id){
        $data = array();
        $data['comment'] = $request->content;
        $data['comment_product_id'] = Auth::user()->id;
        $data['comment_name'] = Auth::user()->name;
        DB::table('comment')->insert($data);
        return redirect()->back();
    }
    public function blog(){
        $blog =news::orderBy('id','ASC')->where('hidden', 1)->get();

        return view('Site.blog',compact('blog'));
    }
    public function news($slug){
        $news =news::orderBy('id','ASC')->where('hidden', 1)->where('slug',$slug)->get();

        return view('Site.blogDetail',compact('news'));
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
        $carts =session()->get('cart');
        $cart=View('Site.contentCart',compact('carts'))->render();
        $cartt=View('Site.cartquick',compact('carts'))->render();
        return response()->json(['contentCart'=> $cart,'cartquick'=> $cartt]);
    } 
    public function checkout(){
        $carts =session()->get('cart');
        
        return view('site.checkout');

    } 
    function addtoWishlist($id){
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
   
     public function WishlistsViews(){
        $Wishlists= session()->get('Wishlists');
        return view("site.WishlistsView",compact('Wishlists'));
    }
    
    public function calendar(){
        $CS = coso::all();
        $DV = dichvucoso::all();
        return view("site.calendar",['CS'=>$CS],['DV'=>$DV]);
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
        $data->save();
        return redirect('calendar');
    }

}

