@extends('layouts.app')

@section('content')

<h1>Index - pagina di ricerca avanzata</h1>
<div>visualizzare i risultati della select, rimanda alla show del singolo medico</div> <br>
<a href="{{ route('homepage') }}">Torna alla home</a>

<table class="table table-hover my-table">
    <thead>
      <tr>
        <th scope="col">Nome</th>
        <th scope="col">Mail</th>
        <th scope="col">Immagine</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>
                <a href="{{route('show', compact('user'))}}">
                    {{$user->name}} {{$user->lastname}}
                </a>
            </td>
            <td>{{$user->email}}</td>
            <td><img src="{{ asset($user->profile_image) }}" width="150px"></td>
        </tr>
        @endforeach
    </tbody>
  </table>

  @endsection