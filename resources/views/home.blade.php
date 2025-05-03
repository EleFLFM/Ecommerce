@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(auth()->user()->role === 'admin')
                    <h1>contenido para admin</h1>
                    @elseif(auth()->user()->role === 'client')
                    <h1>contenido para cliente</h1>
                    @else
                    <h1>contenido para otro</h1>
                    @endif
                    {{ __("You're logged in!") }}
             
               
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
