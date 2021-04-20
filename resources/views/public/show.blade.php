@extends('layouts.app')
@section('title', 'Show')
@section('content')
<h1 class="custom-h1">Pagina Dottore</h1>
<div class="card doctor-card">
    <div class="card-body">
        <img src="{{asset($user->profile_image)}}">
        <h2 class="card-title"><i class="fas fa-user-md" style="color: #32bea6"></i> {{$user->name}} {{$user->lastname}}
        </h2>
        <div class="card-text" id="specs">
            @foreach ($user->specializations as $spec)
            <h5>&diams; {{$spec->spec_name}}</h5>
            @endforeach
        </div>
        <hr>
        <p class="card-text"><strong>Email:</strong> {{$user->email}}</p>
        <p class="card-text"><strong>Indirizzo:</strong> {{$user->address}}</p>
        <button class="btn custom-button"><a href="{{ route('index') }}">Torna all'indexx</a></button>
        <hr>


        @foreach ($reviews as $review)
            @if ($review->user_id === $user->id)
                @for ($i = 0; $i < ($review->rv_vote); $i++)
                    <i class="fas fa-star"></i>
                @endfor
                <h3>{{$review->rv_title}}</h3> <br>
                <p style="width:250px">{{$review->rv_content}}</p> <br>
                <h5>{{$review->rv_name}} {{$review->rv_lastname}}</h5>
                <hr>
            @endif

        @endforeach
    </div>
</div>

@endsection
