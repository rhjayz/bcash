@extends('layouts.templatepelanggan')
@section('title', 'Pesan Masakan')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @if(session('success'))
                    <div class="alert alert-success">
                        <b>Success!! </b> {{ session('success') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">

                        <form action="{{ route('pelanggan_order.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label h3">No Meja : {{ $data->no_meja }}</label>
                                        <input type="hidden" name="id_meja" value="{{ $data->id_meja }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Atas Nama</label>
                                        <input type="text" name="nama_user" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Keterangan</label>
                                        <textarea name="keterangan" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-block">Order</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection