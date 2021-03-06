<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\coupon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\coupon\couponInterface;
use Carbon\Carbon;

class couponController extends Controller
{
    protected $coupon;
    public function __construct(couponInterface $coupon)
    {
        $this->coupon = $coupon;
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $temm = $request->all();
        $ketthuc = $request->ketthuc;
        $ids = $request->ids;
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $data = $this->coupon->getAll();
        foreach ($data as $test) {
            $id = $test->id;
            $ngayket = $test['coupon_date_end'];
            if($now > $test['coupon_date_end'] || $test['coupon_qty'] == 0 || $test['coupon_qty'] == null){
                $idne = $test->id;
                $update = coupon::find($id);
                $update->id = $idne;
                $update->id_status = 2;
                $update->save();
            }else{
                $idne = $test->id;
                $update = coupon::find($id);
                $update->id = $idne;
                $update->id_status = 1;
                $update->save();
            }
        }
        return view('admin.coupon.index', compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupon.create');
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
            'coupon_name' => 'required|unique:coupon',
            'coupon_date_start' => 'required|date',
            'coupon_date_end' => 'required|date|after:coupon_date_start',
            'coupon_qty' => 'required',
            'coupon_condition' => 'required',
            'coupon_code' => 'required',
            'coupon_number' => 'required',
        ],
        [
            'coupon_name.required' => 'T??n m?? gi???m gi?? kh??ng ????? tr???ng',
            'coupon_date_start.required' => 'Ng??y b???t ?????u kh??ng ????? tr???ng',
            'coupon_date_end.required' => 'Ng??y k???t th??c kh??ng ????? tr???ng',
            'coupon_date_end.date' => 'Ng??y k???t th??c kh??ng ???????c tr?????c th???i gian b???t ?????u',
            'coupon_qty.required' => 'S??? l?????ng kh??ng ????? tr???ng',
            'coupon_condition.required' => 'ch???n gi???m theo % | gi???m theo gi?? ti???n',
            'coupon_code.required' => 'name code m?? gi???m gi?? kh??ng ????? tr???ng',
            'coupon_number.required' => 's??? ti???n gi???m kh??ng ????? tr???ng',
            'coupon_name.unique' => 'T??n m?? gi???m gi?? n??y ???? c?? trong CSDL',
        ]);
        if($this->coupon->create($request->all())){
            return redirect()->route('coupon.index')->with('success', 'th??m m?? gi???m gi?? th??nh c??ng');
        }else{
            return redirect()->route('coupon.index')->with('error', 'th??m m?? gi???m gi?? th???t b???i');
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
        $coupon = $this->coupon->find($id);
        return view('admin.coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'coupon_name' => 'required',
            'coupon_date_start' => 'required|date',
            'coupon_date_end' => 'required|date|after:coupon_date_start',
            'coupon_qty' => 'required',
            'coupon_condition' => 'required',
            'coupon_code' => 'required',
            'coupon_number' => 'required',
        ],
        [
            'coupon_name.required' => 'T??n m?? gi???m gi?? kh??ng ????? tr???ng',
            'coupon_date_start.required' => 'Ng??y b???t ?????u kh??ng ????? tr???ng',
            'coupon_date_end.required' => 'Ng??y k???t th??c kh??ng ????? tr???ng',
            'coupon_date_end.date' => 'Ng??y k???t th??c kh??ng ???????c tr?????c th???i gian b???t ?????u',
            'coupon_qty.required' => 'S??? l?????ng kh??ng ????? tr???ng',
            'coupon_condition.required' => 'ch???n gi???m theo % | gi???m theo gi?? ti???n',
            'coupon_code.required' => 'name code m?? gi???m gi?? kh??ng ????? tr???ng',
            'coupon_number.required' => 's??? ti???n gi???m kh??ng ????? tr???ng',
        ]);
        if($this->coupon->update($id,$request->all()))
        {
            return redirect()->route('coupon.index')->with('success', 's???a coupon th??nh c??ng');
        }
        else{
            return redirect()->route('coupon.index')->with('error', 'c???p nh???t kh??ng th??nh c??ng');
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
        $oke = $this->coupon->find($id);
        $oke->delete();
            return redirect()->route('coupon.index')->with('success', 'x??a th??nh c??ng !!!');
    }

    public function deletecoupon(Request $request)
    {
        $ids = $request->ids;
        coupon::whereIn('id', $ids)->delete();
        return reponse()->json(['success'=>"delete all"]);
    }
}
