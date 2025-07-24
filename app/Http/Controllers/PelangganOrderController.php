<?php

namespace App\Http\Controllers;

use App\Order;
use App\Meja;
use App\DetailOrder;
use App\Masakan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PelangganOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Meja::where('id_meja', Session::get('id_meja'))->first();
        return view('pages.pelanggan.order.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.pelanggan.order.menu');
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

        return redirect()->route('pelanggan.order.menu', $order->id_order);
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

    public function menu($id)
    {
        $order = Order::with('get_user', 'get_meja')->where('id_order', $id)->first();
        $masakan = Masakan::where('status_masakan', 'Tersedia')->get();

        $detail_order = DetailOrder::with('get_masakan')->where('id_order', $id)->get();

        return view('pages.pelanggan.order.menu', ['order'=>$order, 'masakan'=>$masakan, 'detail_order'=>$detail_order]);
    }

     public function destroy(DetailOrder $detailOrder)
    {
        $idOrder = $detailOrder->id_order;
        $detailOrder->delete();

        return redirect()->route('pelanggan.order.select_menu', $idOrder);
    }

    public function pesan($idOrder)
    {
        $order = DetailOrder::where('id_order', $idOrder)->get();

        foreach ($order as $value){
            $value->update(['status_detail_order' => 'Belum di Antar']);
        }

        return redirect()->route('pelanggan.order.list_pesanan', $idOrder);
    }

    public function list_pesanan($idOrder)
    {
        $order = Order::with('get_user')->where('id_order', $idOrder)->first();
        $detail_order = DetailOrder::with('get_masakan')->where('id_order', $idOrder)->get();
        return view('pages.pelanggan.order.list_pesanan', ['order'=>$order, 'detail_order'=>$detail_order]);
    }

    public function input(Request $request, $idOrder)
    {
        $detail_order = DetailOrder::where('id_masakan', $request->id_masakan)->where('id_order', $idOrder)->first();
        if ($detail_order){
            $detail_order->qty += $request->qty;
            $detail_order->total_harga += $request->total_harga;
            if ($detail_order->keterangan == ""){
                $detail_order->keterangan = $request->keterangan;
            }else{
                $detail_order->keterangan = $detail_order->keterangan . ', ' .$request->keterangan;
            }
            $detail_order->update();
        }else{
            DetailOrder::create([
                'id_order' => $idOrder,
                'id_masakan' => $request->id_masakan,
                'qty' => $request->qty,
                'total_harga' => $request->total_harga,
                'keterangan' => $request->keterangan,
                'status_detail_order' => 'Belum Selesai'
            ]);
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DetailOrder  $detailOrder
     * @return \Illuminate\Http\Response
     */
}
