@extends('layouts.app')
@section('title', 'Edit')
@section('content')

<h1 class="custom-h1">Modifica qui i tuoi dati</h1>

<form action="{{ route('update', compact('user')) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Nome</label>
        <input type="text" class="form-control" name="name" aria-describedby="emailHelp"
            placeholder="Inserisci il nome..." value="{{ $user->name }}">
    </div>

    <div class="form-group">
        <label for="lastname">Cognome</label>
        <input type="text" class="form-control" name="lastname" placeholder="Inserisci il cognome..."
            value="{{ $user->lastname }}">
    </div>

    <div class="form-group">
        <label for="specializations">Specializzazione</label>
        <select class="form-control" id="specializations" name="specializations[]" multiple>
            <option value="">nessuno</option>
            @foreach ($specs as $spec)
            <option value="{{ $spec->id }}" @foreach ($user->specializations as $userSpec)
                @if($userSpec->id===$spec->id)
                selected @endif
                @endforeach
                >{{ $spec->spec_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="email">Mail</label>
        <input type="text" class="form-control" name="email" placeholder="Inserisci la mail..."
            value="{{ $user->email }}">
    </div>

    <div class="form-group">
        <label for="lastname">Indirizzo</label>
        <input type="text" class="form-control" name="address" placeholder="Inserisci l'indirizzo..."
            value="{{ $user->address }}">
    </div>

    <div class="form-group">
        <label for="phone_number">Numero di telefono</label>
        <input type="text" class="form-control" name="phone_number" placeholder="Inserisci il numero di telefono..."
            value="{{ $user->phone_number }}">
    </div>

    <div class="form-group">
        <label for="profile_image">Immagine di profilo</label>
        <input type="file" class="form-control" name="profile_image" placeholder="Inserisci un'immagine di profilo..."
            value="{{ $user->profile_image }}">
    </div>

    <div class="form-group">
        <label for="curriculum">Curriculum</label>
        <input type="file" class="form-control" name="curriculum" placeholder="Inserisci il curriculum..."
            value="{{ $user->curriculum }}">
    </div>

    <button type="submit" class="btn custom-button">Modifica</button>
    <button class="btn custom-button">
        <a href="{{ route('dashboard') }}">
            Ritorna alla dashboard
        </a>
    </button>


</form>

@endsection
