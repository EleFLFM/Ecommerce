@extends('layouts.admin')

@section('admin-content')
    <h1>Panel de Control</h1>
    <table class="users-table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    @if($user->role === 'client')
                    <form action="{{ route('admin.make-admin', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit">Hacer Admin</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection