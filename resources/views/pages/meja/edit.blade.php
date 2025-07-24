@extends('layouts.templateadmin')

@section('content')

<br>
<br>
<br>

<form action="{{route('meja.update',$data)}}" method="post">
@csrf
@method('PATCH')
@if(session('pesan'))
<div class="alert alert-success">
    <b>Success!! </b> {{ session('pesan') }}
</div>
@endif
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
		<div class="card-header"><a href="" class="btn btn-primary"> Back</a></div>
        <div class="card-body">
          <div class="card-block">
            <h4 class="card-title" align="center">Meja</h4>
            <div class="form-group">
              <label for="">Nomor Meja</label>

              <input type="number" class="form-control" name="no_meja" value="{{$data['no_meja']}}" required>
            </div>

            <button class="btn btn-success">Simpan</button>
            </div>
        </div>
      </div>
		</div>
	</div>
</div>
</form>

@endsection