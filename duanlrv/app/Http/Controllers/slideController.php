<?php

namespace App\Http\Controllers;

use App\Models\slide;
use App\Models\navmenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\slide\slideInterface;

class slideController extends Controller
{
    protected $slide;
    public function __construct(slideInterface $slide)
    {
        $this->slide = $slide;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->slide->getAll();
        $danhmuc = navmenu::orderBy('id', 'ASC')->select('id','name_nav')->get();
        return view('admin.slide.index', compact('data','danhmuc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $danhmuc = navmenu::orderBy('id', 'ASC')->select('id','name_nav')->get();
        return view('admin.slide.create', compact('danhmuc'));
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
            'image' => 'required',
            'tieu_de' => 'required',
            'thong_tin' => 'required',
            'khuyen_mai' => 'required',
        ],
        [
            'image.required' => 'Hình slide không để trống',
            'tieu_de.required' => 'Tiêu đề không để trống',
            'thong_tin.required' => 'thông tin không để trống',
            'khuyen_mai.required' => 'tin khuyến mãi không để trống',
        ]);
        if($this->slide->create($request->all()))
        {
            return redirect()->route('slide.index')->with('success', 'xét duyệt thành công');
        }
        else{
            return redirect()->route('slide.index')->with('error', 'xét duyệt thất bại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function show(slide $slide)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slide = $this->slide->find($id);
        $danhmuc = navmenu::orderBy('id', 'ASC')->select('id','name_nav')->get();
        return view('admin.slide.edit', compact('danhmuc','slide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'required',
            'tieu_de' => 'required',
            'thong_tin' => 'required',
            'khuyen_mai' => 'required',
        ],
        [
            'image.required' => 'Hình slide không để trống',
            'tieu_de.required' => 'Tiêu đề không để trống',
            'thong_tin.required' => 'thông tin không để trống',
            'khuyen_mai.required' => 'tin khuyến mãi không để trống',
        ]);
        if($this->slide->update($id,$request->all()))
        {
            return redirect()->route('slide.index')->with('success', 'xét duyệt thành công');
        }
        else{
            return redirect()->route('slide.index')->with('error', 'xét duyệt thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $delete = $this->slide->find($id);
        $delete->delete();
        return redirect()->route('slide.index')->with('success', 'xóa thành công');
    }
    public function deleteslide(Request $request)
    {
        $ids = $request->ids;
        slide::whereIn('id', $ids)->delete();
        echo 'thanhcong';
        return reponse()->json(['success'=>"delete all"]);
    }
}
