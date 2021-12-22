<?php

namespace App\Http\Controllers;

use App\Models\datlich;
use App\Models\trangthai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\datlich\datlichInterface;
class datlichController extends Controller
{
    protected $datlich;
    public function __construct(datlichInterface $datlich)
    {
        $this->datlich = $datlich;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->datlich->getAll();
        $xetduyet = trangthai::orderBy('id', 'ASC')->select('id','name_type')->get();
        return view('admin.datlich.index', compact('data','xetduyet'));
    }
    public function updatedatlich(Request $request){
        $data = $request->all();
        $id = $data['id'];
        $id_status = $data['id_status'];
        $update = datlich::find($id);
        $update->id_status = $id_status;
        $update->save();
        echo 'done';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chitiet = datlich::orderBy('id','ASC')->where('id', $id)->paginate(10);
        return view('admin.datlich.show', compact('chitiet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
