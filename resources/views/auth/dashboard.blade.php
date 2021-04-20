@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <img src="{{ Auth::user()->profile_image }}" class="card-img-top custom-img" alt="profile-pic">

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <strong style="font-size: 18px">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</strong>
                        <br>
                        {{ __('You are logged in!') }} <br><br>
                        Gestione dati utente registrato, rimanda all'edit <br>
                        <button class="btn custom-button">
                            <a href="{{ route('edit', ['user' => Auth::user()]) }}">
                                Modifica i tuoi dati
                            </a>
                        </button>
                        <button class="btn custom-button">
                            <a href="{{ route('message', ['user' => Auth::user()]) }}">
                                Visualizza messagi
                            </a>
                        </button>
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
