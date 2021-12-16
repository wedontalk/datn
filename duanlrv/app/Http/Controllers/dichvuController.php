<?php

namespace App\Http\Controllers;

use App\Models\dichvucoso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\chitietdichvu\chitietdichvuInterface;

class dichvuController extends Controller
{
    protected $chitietdichvu;
    public function __construct(chitietdichvuInterface $chitietdichvu)
    {
        $this->chitietdichvu = $chitietdichvu;
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->chitietdichvu->getAll();
        return view('admin.chitietdichvu.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.chitietdichvu.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request){
            $them = new dichvucoso();
            $them->name_dichvu = $request['name'];
            $them->id_status = $request['trangthai'];
            $them->save();
            echo 'done';
        }
    }
    public function loadajax(){
        $data = $this->chitietdichvu->getAll();
        return View('admin.chitietdichvu.loadajax',compact('data'));
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
        return view('admin.chitietdichvu.edit');
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
        //
    }

    public function update_ajax(Request $request){
        $id = $request->id;
        $text_dichvu = $request->text_dichvu;
        $update = dichvucoso::find($id);
        $update->name_dichvu = $text_dichvu;
        $update->save();
        if($update->save()){
        echo 'done';
        }else{
            echo '';
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
        $delete = $this->chitietdichvu->find($id);
        if($delete->delete()){
            return redirect()->route('chitietdichvu.index');
        }
    }
}
