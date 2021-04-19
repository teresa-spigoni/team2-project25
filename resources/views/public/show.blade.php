@extends('layouts.app')

@section('content')

<h1>Pagina Dottore</h1>
<div>dettagli medico</div> <br>

<div class="card">
    <div class="card-body">
        <img src="{{asset($user->profile_image)}}" width="200px">
        <h5 class="card-title">{{$user->name}} {{$user->lastname}}</h5>
        <p class="card-text">
            Specializzazioni: 
            @foreach ($user->specializations as $spec)
                {{$spec->spec_name}} 
            @endforeach

        </p>
        <p class="card-text">{{$user->mail}}</p>
        <p class="card-text">{{$user->address}}</p>
        <a href="{{ route('index') }}">Torna all'index</a>
    </div>
</div>

@endsection