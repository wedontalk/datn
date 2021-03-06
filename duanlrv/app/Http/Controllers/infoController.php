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
                    $output.='<option class="op-text">---ch???n danh m???c ---</option>';
                foreach($select_province as $province){
                    $output.='<option class="op-text" value="'.$province->id.'">'.$province->name.'</option>';
                }
            
            // }else{
            //     $select_wards = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
            //     $output.='<option>---Ch???n x?? ph?????ng---</option>';
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
            'title.required' => 'T??n s???n ph???m kh??ng ????? tr???ng',
            'price.required' => 'gi?? s???n ph???m kh??ng ????? tr???ng',
            'price.min' => 'gi?? s???n ph???m ph???i tr??n 4 s???',
            'discount.required' => 'discount kh??ng ????? tr???ng',
            'discount.min' => 'discount s???n ph???m ph???i tr??n 4 s???',
            'quantity.required' => 'S??? l?????ng kh??ng ????? tr???ng',
            'age.required' => '????? tu???i kh??ng ????? tr???ng',
            'status.required' => 't??nh tr???ng s???c kh???e kh??ng ????? tr???ng',
            'render.required' => 'gi???i t??nh kh??ng ????? tr???ng',
            'image.required' => 'h??nh ???nh kh??ng ????? tr???ng',
            'id_menu.required' => 'menu kh??ng ????? tr???ng',
            'id_category.required' => 'danh m???c kh??ng ????? tr???ng',
            'description.required' => 'm?? t??? kh??ng ????? tr???ng',
            'title.unique' => 'T??n s???n ph???m n??y ???? c?? trong CSDL',
        ]);
        $images = $request->image;
        $request->merge(['image' => implode(", ",$images)]);
        $uploadfile = $request->merge(['id_product' => $request->id]);
        $request->merge(['slug_product' => \Str::slug($request->title).'-'. \Carbon\Carbon::now()->timestamp]);
        $request->merge(['type_post' => 2]);
        if($this->qlthucung->create($request->all()))
        {
            return redirect()->route('qlthucung.index')->with('success', 'x??t duy???t th??nh c??ng');
        }
        else{
            return redirect()->route('qlthucung.index')->with('error', 'x??t duy???t th???t b???i');
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
            'title.required' => 'T??n s???n ph???m kh??ng ????? tr???ng',
            'price.required' => 'gi?? s???n ph???m kh??ng ????? tr???ng',
            'price.min' => 'gi?? s???n ph???m ph???i tr??n 4 s???',
            'discount.required' => 'discount kh??ng ????? tr???ng',
            'discount.min' => 'discount s???n ph???m ph???i tr??n 4 s???',
            'quantity.required' => 'S??? l?????ng kh??ng ????? tr???ng',
            'age.required' => '????? tu???i kh??ng ????? tr???ng',
            'status.required' => 't??nh tr???ng s???c kh???e kh??ng ????? tr???ng',
            'render.required' => 'gi???i t??nh kh??ng ????? tr???ng',
            'image.required' => 'h??nh ???nh kh??ng ????? tr???ng',
            'id_menu.required' => 'menu kh??ng ????? tr???ng',
            'id_category.required' => 'danh m???c kh??ng ????? tr???ng',
            'description.required' => 'm?? t??? kh??ng ????? tr???ng',
        ]);
        $images = $request->image;
        $request->merge(['image' => implode(", ",$images)]);
        $uploadfile = $request->merge(['id_product' => $request->id]);
        $dataslug = \Str::slug($request->title).'-'.\Carbon\Carbon::now()->timestamp;
        $request->merge(['slug_product' => $dataslug]);
        $request->merge(['type_post' => 2]);
        if($this->qlthucung->update($id,$request->all()))
        {
            return redirect()->route('qlthucung.index')->with('success', 'x??t duy???t th??nh c??ng');
        }
        else{
            return redirect()->route('qlthucung.index')->with('error', 'x??t duy???t th???t b???i');
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
        return redirect()->route('qlthucung.index')->with('success', 'x??a th??nh c??ng');
    }
    public function deletethucung(Request $request)
    {
        $ids = $request->ids;
        information::whereIn('id', $ids)->delete();
        return reponse()->json(['success'=>"delete all"]);
    }
}
