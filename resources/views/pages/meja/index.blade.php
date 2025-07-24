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
		<div class="card-header"><a href="{{route('meja.create')}}" class="btn btn-primary">+ Add</a></div>
        <div class="card-body">
          <div class="card-block">
            <h4 class="card-title" align="center">Meja</h4>
            <center>
           <table border="1" class="table table-hovered table-bordered zero-configuration" align="center">
           		<thead align="center">
           			<tr>
           			<th>No</th>
           			<th>Nomor Meja</th>
           			<th>Status Meja</th>
           			<th>Action</th>
           			</tr>
           		</thead>
           		<tbody align="center">
           		@foreach($meja as $datamejas)
           			<tr>
           				<td>{{$loop->index + 1}}</td>
           				<td>{{$datamejas->no_meja}}</td>
           				<td align="center">
           					<div class="badge {{ $datamejas->status_meja == '1' ? 'badge-success' : 'badge-danger'}}">
           					{{ $datamejas->status_meja == '1' ? 'Terisi' : 'Kosong'}}
           					</div>
           				</td>
           				<td align="center">
           					<div class="btn-group">
           					<form action="{{route('meja.destroy',$datamejas)}}" method="POST">
           					@csrf @method('DELETE')

           					<button onclick="return confirm('Are You Sure?')" class="btn btn-danger"><i class="ft-trash"></i></button> 	
           					<a href="{{route('meja.edit',$datamejas)}}" class="btn btn-warning "><i class="ft-edit"></i></a>
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

@push('js_script')
<!-- <script>
        $(document).ready(function () {
            $('#datatables').dataTable({
                "info": false
            });
        })
</script> -->

@endpush