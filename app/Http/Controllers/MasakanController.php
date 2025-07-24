<?php

namespace App\Http\Controllers;

use App\Masakan;
use Illuminate\Http\Request;

class MasakanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Masakan::all();
        return view('pages.makanan.index',compact('menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.makanan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'gambar' => ['mimes:jpg,jpeg,JPEG,png','max:2024'],
        ]);

        $gambar = $request->file('gambar')->getClientOriginalName();
        $destination = base_path() . '/public/assets/img/';
        $request->file('gambar')->move($destination, $gambar );

        Masakan::create([
            'masakan'=>$request->masakan,
            'harga'=>$request->harga,
            'jenis'=>$request->jenis,
            'gambar' => $gambar,
            'status_masakan'=>$request->status_masakan,
        ]);

        return redirect()->route('masakan.index')->with('success', 'Input Data Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Masakan  $masakan
     * @return \Illuminate\Http\Response
     */
    public function show(Masakan $masakan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Masakan  $masakan
     * @return \Illuminate\Http\Response
     */
    public function edit(Masakan $masakan)
    {   
        return view('pages.makanan.edit',['data'=>$masakan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Masakan  $masakan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Masakan $masakan)
    {
        $gambar = $request->file('gambar')->getClientOriginalName();
        $destination = base_path() . '/public/assets/img/';
        $request->file('gambar')->move($destination, $gambar );

        $masakan->update([
            'masakan'=>$request->masakan,
            'harga'=>$request->harga,
            'jenis'=>$request->jenis,
            'gambar' => $gambar,
            'status_masakan'=>$request->status_masakan,
        ]);
        return redirect()->route('masakan.index')->with('pesan','Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Masakan  $masakan
     * @return \Illuminate\Http\Response
     */
    public function destroy($masakan)
    {
        Masakan::destroy($masakan);
        return back()->with('pesan','Berhasil dihapus');
    }

    public function masakan(Masakan $masakan)
    {
        return json_encode(['code'=>200, 'message'=>'api.masakan', 'data'=>$masakan]);
    }
}
