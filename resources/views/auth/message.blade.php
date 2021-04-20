@extends('layouts.app')

@section('title', 'Messaggi')

@section('content')

    <h1>Pagina messaggi</h1>
    <button class="btn custom-button"><a href="{{ route('dashboard') }}">Torna alla DashBoard</a></button>
    @foreach ($userMessages as $message)
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Da: {{ $message->msg_name }} {{ $message->msg_lastname }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">E-Mail: <br> {{ $message->msg_email }} <br><br>
                    Numero di telefono: <br>{{ $message->msg_phone_number }}</h6>
                <p class="card-text">{{ $message->msg_content }}</p>
            </div>
        </div>

    @endforeach

@endsection
