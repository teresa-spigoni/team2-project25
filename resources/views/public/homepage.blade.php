@extends('layouts.app')
@section('title', 'Home')
@section('content')
<h1 class="custom-h1">CERCA IL DOTTORE ADATTO A TE</h1>
<form action="{{ route('toIndex') }}" method="post">
    @csrf
    @method('GET')
    <div class="form-group">
        <select class="form-control" id="specialization" name="specialization" required>
            <option value="">Seleziona la specializzazione</option>
            @foreach ($specializations as $spec)
            <option value="{{ $spec->id }}" class="opt">{{ $spec->spec_name }}</option>
            @endforeach
        </select>
        <button class="btn custom-button">
            Cerca
        </button>
        <br><br>

        <h3>Medici in evidenza</h3>
        @foreach ($activeSponsorship as $theuser)
        <a href="/doctors/{{$theuser->id}}/{{$theuser->specializations}} ">
            <div class="card" style="padding: 20px">
                <img src="{{$theuser->profile_image}}" alt="" style="border-radius: 50%; width: 250px">
                {{$theuser->name}} {{$theuser->lastname}} <br>
                @foreach ($theuser->specializations as $spec)
                {{ $spec->spec_name }}
                @endforeach
            </div>
        </a>
        @endforeach
    </div>
</form>
@endsection
