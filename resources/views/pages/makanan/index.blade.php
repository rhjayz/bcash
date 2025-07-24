@extends('layouts.templateadmin')

@section('content')



<div class="container">

<br>
<br>
<br>
	<div class="row">
		@if(session('pesan'))
<div class="alert alert-success">
    <b>Success!! </b> {{ session('pesan') }}
</div>
@endif
		<div class="col-md-12">
			<div class="card">
		<div class="card-header"><a href="{{route('masakan.create')}}" class="btn btn-primary">+ Add</a></div>
        <div class="card-body">
          <div class="card-block">
            <h4 class="card-title" align="center">Masakan</h4>
            <br>
            <center>
           <table border="1" class="table table-hovered table-bordered zero-configuration" align="center" id="datatables">
           		<thead align="center">
           			<tr>
           			<th>No</th>
                <th>Nama Masakan</th>
                <th>Harga</th>
                <th>Jenis Masakan</th>
                <th>Gambar</th>
                <th>Status Masakan</th>
                <th>Action</th>
           			</tr>
           		</thead>
           		<tbody align="center">
           		@foreach($menu as $menus)
           			<tr>
           				<td>{{$loop->index + 1}}</td>
           				<td>{{$menus->masakan}}</td>
                  <td>Rp.{{$menus->Harga}}</td>
           				<td align="center">
           					<div class="badge {{ $menus->jenis_masakan == 'tersedia' ? 'badge-success' : 'badge-danger'}}">
           					{{ $menus->jenis_masakan == 'Tersedia' ? 'Tersedia' : 'Kosong'}}
           					</div>
           				</td>
                  <td >
                     <img src="{{ asset('/assets/img').'/'.$menus->gambar }}" alt="{{ $menus->gambar }}" width="200" height="200">
                  </td>
                  <td>
                    <div class="badge{{ $menus->jenis_makanan == 'makanan' ? 'badge-success' : 'badge-danger'}}">
                      {{$menus->jenis_masakan == 'Makanan' ? 'Makanan' : 'Minuman'}}
                    </div>     
                  </td>
           				<td align="center">
           					<div class="btn-group">
           					<form action="{{route('masakan.destroy',$menus)}}" method="POST">
           					@csrf @method('DELETE')

           					<button onclick="return confirm('Are You Sure?')" class="btn btn-danger"><i class="ft-trash"></i></button> 	
           					<a href="{{route('masakan.edit',$menus)}}" class="btn btn-warning "><i class="ft-edit"></i></a>
           					</form>
           					</div>

           				</td>
           				
           			</tr>
           		@endforeach
           			
           		</tbody> 	
           </table>
            </center>
            </div>
        </div>
      </div>
		</div>
	</div>
</div>

@endsection