<?php

namespace App\Http\Controllers;

use App\Order;
use App\Meja;
use App\DetailOrder;
use App\Masakan;
use App\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Meja::where('status_meja','0')->get();
        return view('pages.order.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.order.menu');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $user = User::firstOrCreate(
            ['username'=> $request->nama_user],
            ['nama_user'=> $request->nama_user, 'id_level'=>'5']
        );

        $order = Order::create([
            'id_meja' => $request->id_meja,
            'id_user' => $user->id_user,
            'tanggal' => date('Y-m-d H:i:s'),
            'keterangan' => $request->keterangan,
            'status_order' => 'Belum Bayar'
        ]);

        return redirect()->route('order.menu', $order->id_order);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function menu($id)
    {
        $order = Order::with('get_user', 'get_meja')->where('id_order', $id)->first();
        $masakan = Masakan::where('status_masakan', 'Tersedia')->get();

        $detail_order = DetailOrder::with('get_masakan')->where('id_order', $id)->get();

        return view('pages.order.menu', ['order'=>$order, 'masakan'=>$masakan, 'detail_order'=>$detail_order]);
    }
}
