@extends('layouts.templateadmin')

@section('content')

	<p>Selamat datang {{ Auth::user()->name }} sebagai {{ Auth::user()->id_level }}</p>

@endsection