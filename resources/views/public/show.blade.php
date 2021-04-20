@extends('layouts.app')
@section('title', 'Show')
@section('content')
    <h1 class="custom-h1">Pagina Dottore</h1>
    <div class="card doctor-card">
        <div class="card-body">
            <img src="{{ asset($user->profile_image) }}">
            <h2 class="card-title"><i class="fas fa-user-md" style="color: #32bea6"></i> {{ $user->name }}
                {{ $user->lastname }}
            </h2>
            <div class="card-text" id="specs">
                @foreach ($user->specializations as $spec)
                    <h5>&diams; {{ $spec->spec_name }}</h5>
                @endforeach
            </div>
            <hr>
            <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
            <p class="card-text"><strong>Indirizzo:</strong> {{ $user->address }}</p>
            <button class="btn custom-button">
                <a href="{{ route('index') }}">
                    Torna all'index
                </a>
            </button>
            <button type="button" class="btn custom-button" data-toggle="modal" data-target="#message">
                <a href="{{route('newMessage', compact('user'))}}">Manda un messaggio</a>
            </button>
        </div>
    </div>

@endsection
