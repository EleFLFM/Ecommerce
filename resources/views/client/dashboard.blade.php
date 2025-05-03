@extends('layouts.app')

@section('content')
    <h1>Bienvenido, {{ Auth::user()->name }}</h1>
    <p>Esta es la vista del usuario.</p>
@endsection
