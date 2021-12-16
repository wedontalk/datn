<?php

namespace App\Http\Controllers;


use App\Models\dichvucoso;
use App\Models\coso;
use App\Models\thuocdichvu;
use App\Models\thanhpho;
use App\Models\quanhuyen;
use App\Models\xaphuong;
use App\Models\trangthai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\qldichvu\qldichvuInterface;

class cosoController extends Controller
{
    protected $qldichvu;
    public function __construct(qldichvuInterface $qldichvu)
    {
        $this->qldichvu = $qldichvu;
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->qldichvu->getAll();
        return view('admin.qldichvu.index', compact('data'));
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $xetduyet = trangthai::orderBy('id', 'ASC')->select('id','name_type')->get();
        $dichvu = dichvucoso::orderBy('id', 'ASC')->select('id','name_dichvu')->get();
        $thanhpho = thanhpho::orderBy('matp', 'ASC')->get();
        $quanhuyen = quanhuyen::orderBy('id', 'ASC')->get();
        $xaphuong = xaphuong::orderBy('id', 'ASC')->get();
        return view('admin.qldichvu.create', compact('thanhpho','quanhuyen','xaphuong','xetduyet','dichvu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_coso' => 'required|unique:coso_thucung',
            'time_hoatdong' => 'required',
            'time_ketthuc' => 'required',
            'phone_coso' => 'required',
            'address_cuthe' => 'required',
            'id_xaphuong' => 'required',
            'id_quanhuyen' => 'required',
            'id_province' => 'required',
            'image' => 'required',
        ],
        [
            'name_coso.required' => 'Tên menu không để trống',
            'name_coso.unique' => 'Tên menu này đã có trong CSDL',
            'time_hoatdong.required' => 'Thời gian hoạt động không được để trống',
            'time_ketthuc.required' => 'Thời gian Kết thúc không được để trống',
            'phone_coso.required' => 'Số điện thoại không được để trống',
            'address_cuthe.required' => 'Địa chỉ cụ thể không được để trống',
            'id_xaphuong.required' => 'Xã phường không được để trống',
            'id_quanhuyen.required' => 'Quận Huyện, Thị Trấn không được để trống',
            'id_province.required' => 'Tỉnh, Thành Phố không được để trống',
            'image.required' => 'Hình đại diện không được để trống',
        ]);
        if($this->qldichvu->create($request->all()))
        {
            return redirect()->route('qldichvu.index')->with('success', 'xét duyệt thành công');
        }
        else{
            return redirect()->route('qldichvu.index')->with('error', 'xét duyệt thất bại');
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
    public function edit($id, Request $request)
    {
        $data = $request->all();
        $qldichvu = $this->qldichvu->find($id);
        $xetduyet = trangthai::orderBy('id', 'ASC')->select('id','name_type')->get();
        $dichvu = dichvucoso::orderBy('id', 'ASC')->select('id','name_dichvu')->get();
        $thanhpho = thanhpho::orderBy('matp', 'ASC')->get();
        $quanhuyen = quanhuyen::orderBy('id', 'ASC')->get();
        $xaphuong = xaphuong::orderBy('id', 'ASC')->get();
        return view('admin.qldichvu.edit', compact('qldichvu','dichvu','thanhpho','quanhuyen','xaphuong','xetduyet'));
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
            'name_coso' => 'required',
            'time_hoatdong' => 'required',
            'time_ketthuc' => 'required',
            'phone_coso' => 'required',
            'address_cuthe' => 'required',
            'id_xaphuong' => 'required',
            'id_quanhuyen' => 'required',
            'id_province' => 'required',
            'image' => 'required',
        ],
        [
            'name_coso.required' => 'Tên cơ sở không để trống',
            'time_hoatdong.required' => 'Thời gian hoạt động không được để trống',
            'time_ketthuc.required' => 'Thời gian Kết thúc không được để trống',
            'phone_coso.required' => 'Số điện thoại không được để trống',
            'address_cuthe.required' => 'Địa chỉ cụ thể không được để trống',
            'id_xaphuong.required' => 'Xã phường không được để trống',
            'id_quanhuyen.required' => 'Quận Huyện, Thị Trấn không được để trống',
            'id_province.required' => 'Tỉnh, Thành Phố không được để trống',
            'image.required' => 'Hình đại diện không được để trống',
        ]);
        if($this->qldichvu->update($id,$request->all()))
        {
            return redirect()->route('qldichvu.index')->with('success', 'xét duyệt thành công');
        }
        else{
            return redirect()->route('qldichvu.index')->with('error', 'xét duyệt thất bại');
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
        $delete = $this->qldichvu->find($id);
        $delete->delete();
        return redirect()->route('qldichvu.index')->with('success', 'xóa thành công');
    }
    public function deletecoso (Request $request){
        $ids = $request->ids;
        coso::whereIn('id', $ids)->delete();
        return reponse()->json(['success'=>"delete all"]);
    }
}
