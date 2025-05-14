@extends('layouts.admin-app')

@section('content')
    <h1>Bienvenido, {{ Auth::user()->name }}</h1>
    <p>Esta es la vista del Admin.</p>
@endsection