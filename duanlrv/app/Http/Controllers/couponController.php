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
        if($this->coupon->create($request->all())){
            return redirect()->route('coupon.index')->with('success', 'thêm mã giảm giá thành công');
        }else{
            return redirect()->route('coupon.index')->with('error', 'thêm mã giảm giá thất bại');
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
        if($this->coupon->update($id,$request->all()))
        {
            return redirect()->route('coupon.index')->with('success', 'sửa coupon thành công');
        }
        else{
            return redirect()->route('coupon.index')->with('error', 'cập nhật không thành công');
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
            return redirect()->route('coupon.index')->with('success', 'xóa thành công !!!');
    }
}
