@extends('layouts.templateadmin')

@section('content')

	<p>Selamat datang <strong>{{ Auth::user()->nama_user }}</strong> sebagai {{ Auth::user()->id_level }}</p>

@endsection