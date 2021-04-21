@extends('layouts.app')
@section('title', 'Show')
@section('content')

    <h5>Sponsorizzazioni</h5>
        @foreach($sponsorships as $sponsor) 
        <div> 
            <div>nome: {{$sponsor->sponsor_name}} </div>
            <div>durata: {{$sponsor->sponsor_duration}} ore</div>
            <div>prezzo: {{$sponsor->sponsor_price}} €</div>
        </div>
        <hr>
        @endforeach

@endsection