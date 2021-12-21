<?php

namespace App\Http\Controllers;

use App\Models\trangthai;
use App\Models\information;
use App\Models\category;
use App\Models\navmenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\qlthucung\qlthucungInterface;

class infoController extends Controller
{
    protected $qlthucung;
    public function __construct(qlthucungInterface $qlthucung)
    {
        $this->qlthucung = $qlthucung;
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->qlthucung->getthucung();
        $danhmuc = navmenu::orderBy('id', 'ASC')->select('id','name_nav','slug')->get();
        $xetduyet = trangthai::orderBy('id', 'ASC')->select('id','name_type')->get();
        foreach($danhmuc as $key => $dm) {
            $nav_id = $dm->id;

                if(isset($_GET['sort_by'])){
                    $sort_by = $_GET['sort_by'];


                    if($sort_by == $dm->slug){
                        $data = information::with('phandanhmuc')->where('type_post', 2)->where('id_menu', $dm->id)->orderBy('id', 'ASC')->paginate(10);
                    }
                }
        }


        return view('admin.qlthucung.index', compact('data','xetduyet','danhmuc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $xetduyet = trangthai::orderBy('id', 'ASC')->select('id','name_type')->get();
        $text = navmenu::orderBy('id', 'ASC')->select('id','name_nav')->get();
        $danhmuc = category::orderBy('id', 'ASC')->select('id','name')->get();
        return view('admin.qlthucung.create', compact('xetduyet','danhmuc','text'));
    }

    public function select_delivery(Request $request){
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action']=="city"){
                $select_province = category::where('id_nav', $data['ma_id'])->orderBy('id', 'ASC')->select('id','name')->get();
                    $output.='<option class="op-text">---chọn danh mục ---</option>';
                foreach($select_province as $province){
                    $output.='<option class="op-text" value="'.$province->id.'">'.$province->name.'</option>';
                }
            
            // }else{
            //     $select_wards = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
            //     $output.='<option>---Chọn xã phường---</option>';
            //     foreach($select_wards as $key => $ward){
            //         $output.='<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
            //     }
            }
            echo $output;

        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:information_post',
            'price' => 'required|min:4',
            'discount' => 'required|min:4',
            'quantity' => 'required',
            'age' => 'required',
            'status' => 'required',
            'render' => 'required',
            'image' => 'required',
            'id_menu' => 'required',
            'id_category' => 'required',
            'description' => 'required',
        ],
        [
            'title.required' => 'Tên sản phẩm không để trống',
            'price.required' => 'giá sản phẩm không để trống',
            'price.min' => 'giá sản phẩm phải trên 4 số',
            'discount.required' => 'discount không để trống',
            'discount.min' => 'discount sản phẩm phải trên 4 số',
            'quantity.required' => 'Số lượng không để trống',
            'age.required' => 'độ tuổi không để trống',
            'status.required' => 'tình trạng sức khỏe không để trống',
            'render.required' => 'giới tính không để trống',
            'image.required' => 'hình ảnh không để trống',
            'id_menu.required' => 'menu không để trống',
            'id_category.required' => 'danh mục không để trống',
            'description.required' => 'mô tả không để trống',
            'title.unique' => 'Tên sản phẩm này đã có trong CSDL',
        ]);
        $images = $request->image;
        $request->merge(['image' => implode(", ",$images)]);
        $uploadfile = $request->merge(['id_product' => $request->id]);
        $request->merge(['slug_product' => \Str::slug($request->title).'-'. \Carbon\Carbon::now()->timestamp]);
        $request->merge(['type_post' => 2]);
        if($this->qlthucung->create($request->all()))
        {
            return redirect()->route('qlthucung.index')->with('success', 'xét duyệt thành công');
        }
        else{
            return redirect()->route('qlthucung.index')->with('error', 'xét duyệt thất bại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $qlthucung = $this->qlthucung->find($id);
        $xetduyet = trangthai::orderBy('id', 'ASC')->select('id','name_type')->get();
        $text = navmenu::orderBy('id', 'ASC')->select('id','name_nav')->get();
        $danhmuc = category::orderBy('id', 'ASC')->select('id','name')->get();
        $danhmucid = information::where('id', $id)->first();
        $danhmucedit = category::orderBy('id')->where('id_nav',$danhmucid->id_menu)->get();
        return view('admin.qlthucung.edit', compact('qlthucung','xetduyet','danhmuc','text','danhmucid','danhmucedit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required|min:4',
            'discount' => 'required|min:4',
            'quantity' => 'required',
            'age' => 'required',
            'status' => 'required',
            'render' => 'required',
            'image' => 'required',
            'id_menu' => 'required',
            'id_category' => 'required',
            'description' => 'required',
        ],
        [
            'title.required' => 'Tên sản phẩm không để trống',
            'price.required' => 'giá sản phẩm không để trống',
            'price.min' => 'giá sản phẩm phải trên 4 số',
            'discount.required' => 'discount không để trống',
            'discount.min' => 'discount sản phẩm phải trên 4 số',
            'quantity.required' => 'Số lượng không để trống',
            'age.required' => 'độ tuổi không để trống',
            'status.required' => 'tình trạng sức khỏe không để trống',
            'render.required' => 'giới tính không để trống',
            'image.required' => 'hình ảnh không để trống',
            'id_menu.required' => 'menu không để trống',
            'id_category.required' => 'danh mục không để trống',
            'description.required' => 'mô tả không để trống',
        ]);
        $images = $request->image;
        $request->merge(['image' => implode(", ",$images)]);
        $uploadfile = $request->merge(['id_product' => $request->id]);
        $dataslug = \Str::slug($request->title).'-'.\Carbon\Carbon::now()->timestamp;
        $request->merge(['slug_product' => $dataslug]);
        $request->merge(['type_post' => 2]);
        if($this->qlthucung->update($id,$request->all()))
        {
            return redirect()->route('qlthucung.index')->with('success', 'xét duyệt thành công');
        }
        else{
            return redirect()->route('qlthucung.index')->with('error', 'xét duyệt thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = $this->qlthucung->find($id);
        $delete->delete();
        return redirect()->route('qlthucung.index')->with('success', 'xóa thành công');
    }
    public function deletethucung(Request $request)
    {
        $ids = $request->ids;
        information::whereIn('id', $ids)->delete();
        return reponse()->json(['success'=>"delete all"]);
    }
}
