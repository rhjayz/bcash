@extends('layouts.templateadmin')

@section('content')

<br>
<br>
<br>

<form action="{{route('masakan.store')}}" method="post" enctype="multipart/form-data" >
@csrf
@if(session('pesan'))
<div class="alert alert-success">
    <b>Success!! </b> {{ session('pesan') }}
</div>
@endif
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
    <div class="card-header"><a href="{{route('masakan.index')}}" class="btn btn-primary"> Back</a></div>
        <div class="card-body">
          <div class="card-block">
            <div class="col-md-12">
              <div class="form-group">
                <label for="" class="form-control-label">Nama Masakan</label>
                <input type="text" class="form-control" name="masakan" required autofocus>
              </div>
              <div class="form-group">
                <label for="" class="form-control-label">Harga</label>
                 <input type="number" class="form-control" name="harga" id="harga" required onkeyup="validate_harga()">
                                    </div>
              <div class="form-group">
                 <label for="" class="form-control-label">Gambar</label>
                  <input type="file" class="form-control" name="gambar" id="gambar" required>
              </div>
                                    <div class="form-group">
                                        <label for="" class="form-control-label">Jenis Masakan</label>
                                        <select class="form-control" name="jenis" required>
                                            <option value="" selected disabled>Pilih Salah Satu</option>
                                            <option value="Makanan">Makanan</option>
                                            <option value="Minuman">Minuman</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-control-label">Status Masakan</label>
                                        <select class="form-control" name="status_masakan" required>
                                            <option value="" selected disabled>Pilih Salah Satu</option>
                                            <option value="Tersedia">Tersedia</option>
                                            <option value="Kosong">Kosong</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-block">Tambah</button>
                                    </div>
                                </div>
            </div>
        </div>
      </div>
		</div>
	</div>
</div>
</form>

@endsection