<?php

namespace App\Http\Controllers;

use App\Meja;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meja = Meja::all();
        return view('pages.meja.index',compact('meja'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.meja.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'no_meja'=>'required|unique:mejas',
        ]);

        Meja::create([
            'no_meja'=>$request->no_meja,
            'status_meja'=>'0',

        ]);

        return back()->with('pesan','Data Berhasil diinput');
            
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Meja  $meja
     * @return \Illuminate\Http\Response
     */
    public function show(Meja $meja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Meja  $meja
     * @return \Illuminate\Http\Response
     */
    public function edit(Meja $meja)
    {
        return view('pages.meja.edit',['data'=>$meja]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Meja  $meja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meja $meja)
    {
        $meja->update($request->except('_method','_token'));
        return redirect()->route('meja.index')->with('pesan','Berhasil DiUpdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Meja  $meja
     * @return \Illuminate\Http\Response
     */
    public function destroy($meja)
    {
        Meja::destroy($meja);
        return back()->with('pesan','Berhasil Dihapus');
    }
}
