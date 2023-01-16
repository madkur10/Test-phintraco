@extends('layout.template')

@section('container')
<h2>hai, {{ Auth::user()->name }}</h2>
<h1>Berhasil Login</h1>
@endsection