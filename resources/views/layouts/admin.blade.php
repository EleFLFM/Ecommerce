@extends('layouts.app')

@section('title', 'Panel Admin')

@section('content')
    <div class="admin-sidebar">
        <h2>Menú Admin</h2>
        <ul>
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('admin.panel') }}">Panel</a></li>
        </ul>
    </div>

    <div class="admin-content">
        @yield('admin-content')
    </div>
@endsection