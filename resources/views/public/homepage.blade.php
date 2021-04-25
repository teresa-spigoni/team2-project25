@extends('layouts.app')
@section('title', 'Home')
@section('content')

<h1 class="custom-h1">CERCA IL DOTTORE ADATTO A TE</h1>

<form action="{{ route('toIndex') }}" method="post">
    @csrf
    @method('GET')

    <div class="form-group">

        {{-- select specializzazioni --}}
        <select class="form-control" id="specialization" name="specialization" required>
            <option value="">Seleziona la specializzazione</option>
            @foreach ($specializations as $spec)
            <option value="{{ $spec->id }}" class="opt">{{ $spec->spec_name }}</option>
            @endforeach
        </select>
        {{-- pulsante di ricerca --}}
        <button class="btn custom-button">
            Cerca
        </button>

        <br><br>

        <h3>Medici in evidenza</h3>

        <div class="container evidence-card">
            {{-- card medico in evidenza --}}
            @foreach ($activeSponsorship as $theuser)
            <div>
                <a href="/doctors/{{$theuser->id}}/{{$theuser->specializations}} ">

                    <div class="card">
                        <img src="{{$theuser->profile_image}}" alt="" class="user-image">
                        <br><br>
                        <h4>{{$theuser->name}} {{$theuser->lastname}}</h4>
                        @foreach ($theuser->specializations as $spec)
                        - {{ $spec->spec_name }} <br>
                        @endforeach
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>

</form>
@endsection
