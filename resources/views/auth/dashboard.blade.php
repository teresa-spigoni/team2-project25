@extends('layouts.app')
@section('title', 'Dashboard')
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
                    <img src="{{asset(Auth::user()->profile_image)}}">
                    <strong style="font-size: 18px">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</strong> <br>
                    {{ __('You are logged in!') }} <br><br>
                    Gestione dati utente registrato, rimanda all'edit <br>
                    <a href="{{ route('edit', ['user' => Auth::user()]) }}">Modifica i tuoi dati</a>
                    <form action="{{ route('destroy', ['user' => Auth::user()]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Elimina account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
