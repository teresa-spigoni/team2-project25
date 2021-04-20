@extends('layouts.app')
@section('title', 'Nuovo Messaggio')
@section('content')
<div>
    <h1>Scrivi al dottor {{$user->name}} {{$user->lastname}}</h1>
    <p>Per favore, compila i campi</p>
</div>
    <form action="{{route('saveMessage', compact('user'))}}" method="POST">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="msg_name">Nome</label>
            <input type="text" class="form-control" id="name" name="msg_name" aria-describedby="emailHelp"
                placeholder="Inserisci il tuo nome">
        </div>
        <div class="form-group">
            <label for="msg_lastname">Cognome</label>
            <input type="text" class="form-control" id="lastname" name="msg_lastname" aria-describedby="emailHelp"
                placeholder="Inserisci il tuo cognome">
        </div>
        <div class="form-group">
            <label for="msg_email">E-Mail</label>
            <input type="text" class="form-control" id="mail" name="msg_email" aria-describedby="emailHelp"
                placeholder="Inserisci la tua Mail">
        </div>
        <div class="form-group">
            <label for="msg_phone_number">Numero di telefono</label>
            <input type="text" class="form-control" id="phone" name="msg_phone_number" aria-describedby="emailHelp"
                placeholder="Inserisci il tuo numero di telefono">
        </div>
        <div class="form-group">
            <label for="msg_content">Messaggio</label><br>
            <textarea name="msg_content" id="msg_content" cols="151" rows="3"></textarea>
        </div>
        <button type="submit" class="btn custom-button">Spedisci il messaggio</button>
    </form>
@endsection
