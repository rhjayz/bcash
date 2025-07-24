@extends('layouts.templatepelanggan')
@section('title', 'Pesan Masakan')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="card-block">    
                        <div class="row">
                            <div class="col-6">
                                <b>{{ $order->get_user->nama_user }}</b>
                            </div>
                            <div class="col-6 text-right">
                                No Meja <b>{{ $order->get_meja->no_meja }}</b>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-4">
                <div class="card border-0 shadow">
                    <div class="card-header bg-primary text-white">
                        <span class="h4">List Pesanan</span>
                    </div>
                    <div class="card-body">
                        <div class="card-block">
                            <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="datatables" class="table table-bordered table-hover table-striped">
                                        <thead>
                                        <tr>
                                            <th>Nama Masakan</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Keterangan</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($detail_order as $value)
                                            <tr>
                                                <td>{{ $value->get_masakan->masakan }}</td>
                                                <td>{{ $value->qty }}</td>
                                                <td>Rp. {{ $value->total_harga }}</td>
                                                <td>{{ $value->keterangan }}</td>
                                                <td align="center">
                                                    <div class="badge {{ $value->status_detail_order == 'Belum di Antar' ? ' badge-warning' : 'badge-success'}}">{{ $value->status_detail_order }}</div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                    <div class="form-group">
                                        <a href="{{ route('pelanggan.dashboard', Session::get('id_meja')) }}" class="btn btn-primary btn-block">Kembali ke Menu Utama</a>
                                    </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection