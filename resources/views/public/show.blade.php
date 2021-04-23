@extends('layouts.app')
@section('title', 'Show')
@section('content')

<div class="card doctor-card">
    <button class="btn button-none b-absolute-tl" @click="historyBack('{{ $spec }}')">
        <i class="fas fa-arrow-left"></i>
    </button>
    <div class="card-body">

        {{-- pulsante per inviare un messaggio --}}
        <button class="btn custom-button b-absolute-tr" data-toggle="modal" data-target="#modalMessage">
            <i class="fas fa-comment-medical" style="margin-right: 5px"></i> Invia un messaggio
        </button>

        {{-- pulsante per scrivere una recensione --}}
        <button class="btn custom-button b-absolute-tr" data-toggle="modal" data-target="#modalReview" style="top:60px">
            <i class="fas fa-plus" style="margin-right: 5px"></i> Scrivi una recensione
        </button>

        {{-- Informazioni del dottore --}}
        <img src="{{ asset($user->profile_image) }}">
        <h2 class="card-title"><i class="fas fa-user-md" style="color: #32bea6"></i> {{ $user->name }}
            {{ $user->lastname }}
        </h2>
        <div class="card-text" id="specs">
            @foreach ($user->specializations as $spec)
            <h5>&diams; {{ $spec->spec_name }}</h5>
            @endforeach
        </div>
        @if (isset($user->phone_number))
        <p class="card-text"><strong>Phone:</strong> {{ $user->phone_number }}</p>
        @endif
        <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
        <p class="card-text"><strong>Indirizzo:</strong> {{ $user->address }}</p>
        <button class="btn custom-button b-absolute-tr" style="top: 101px"><a
                href="{{ isset($user->curriculum) ? asset($user->curriculum) : '' }}" type="application/pdf"
                width="600px" height="300px"><i class="fas fa-file-pdf"
                    style="margin-right: 10px; font-size: 20px"></i>Curriculum</a></button>

        <br>
        {{-- Prestazioni --}}
        <h2>Prestazioni</h2>
        @foreach ($user->services as $service)
        <div class="card" style="width: 500px; padding: 20px; margin-bottom:20px">
            <h3><strong>{{ $service->service_type }}</strong></h3>
            <h4>€{{ $service->service_price }}</h4>
            <div class="card-text"><strong><i class="fas fa-map-marker-alt"></i> Indirizzo:
                </strong>{{ $service->service_address }}</div>
        </div>
        @endforeach

        {{-- Recensioni --}}
        <br><br>
        <hr><br><br>
        <h2>Recensioni</h2>
        @foreach ($reviews as $review)
        @if ($review->user_id === $user->id)
        <div class="card" style="padding: 20px; margin-bottom:20px">
            <div>
                @for ($i = 0; $i < $review->rv_vote; $i++)
                    <i class="fas fa-star" style="color: orange"></i>
                    @endfor
            </div>
            <h3>{{ $review->rv_title }}</h3>
            <p style="width:250px">{{ $review->rv_content }}</p>
            <h5>{{ $review->rv_name }} {{ $review->rv_lastname }}</h5>
        </div>
        @endif
        @endforeach
    </div>
</div>

{{-- modale per scrivere un messaggio --}}
<div class="modal fade" id="modalMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="{{ route('saveMessage', compact('user')) }}" method="post">
        @csrf
        @method('POST')
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Nuovo messaggio</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">

                    {{-- NOME --}}
                    <div class="md-form mb-5">
                        <label data-error="wrong" data-success="right" for="msg_name">Nome</label>
                        <input type="text" class="form-control validate" name="msg_name" required minlength="3"
                            maxlength="50">
                    </div>

                    {{-- COGNOME --}}
                    <div class="md-form mb-4">
                        <label data-error="wrong" data-success="right" for="msg_lastname">Cognome</label>
                        <input type="text" class="form-control validate" name="msg_lastname" required minlength="3"
                            maxlength="50">
                    </div>

                    {{-- EMAIL --}}
                    <div class="md-form mb-4">
                        <label data-error="wrong" data-success="right" for="msg_email">E-Mail</label>
                        <input type="email" class="form-control validate" name="msg_email" required>
                    </div>

                    {{-- NUMERO DI TELEFONO --}}
                    <div class="md-form mb-4">
                        <label data-error="wrong" data-success="right" for="msg_phone_number">Numero di telefono</label>
                        <input type="text" class="form-control validate" name="msg_phone_number" required minlength="9"
                            maxlength="10">
                    </div>

                    {{-- MESSAGGIO --}}
                    <div class="md-form mb-4">
                        <label data-error="wrong" data-success="right" for="msg_content">Messaggio</label>
                        <textarea name="msg_content" id="msg_content" cols="54" rows="3" required
                            minlength="30"></textarea>
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn custom-button">Invia messaggio</button>
                </div>
            </div>
        </div>
    </form>

</div>

{{-- modale per scrivere una recensione --}}
<div class="modal fade" id="modalReview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="{{ route('review') }}" method="post">
        @csrf
        @method('POST')
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Nuova recensione</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">

                    {{-- NOME --}}
                    <div class="md-form mb-5">
                        <label data-error="wrong" data-success="right" for="rv_name">Nome</label>
                        <input type="text" class="form-control validate" name="rv_name" required minlength="3"
                            maxlength="50">
                    </div>

                    {{-- COGNOME --}}
                    <div class="md-form mb-4">
                        <label data-error="wrong" data-success="right" for="rv_lastname">Cognome</label>
                        <input type="text" class="form-control validate" name="rv_lastname" required minlength="3"
                            maxlength="50">
                    </div>

                    {{-- VOTO --}}
                    <div class="md-form mb-4">
                        <label data-error="wrong" data-success="right" for="rv_vote">Voto</label>
                        <input type="number" class="form-control validate" name="rv_vote" required min="1" max="5">
                    </div>

                    {{-- TITOLO --}}
                    <div class="md-form mb-4">
                        <label data-error="wrong" data-success="right" for="rv_title">Titolo</label>
                        <input type="text" class="form-control validate" name="rv_title" required minlength="4"
                            maxlength="20">
                    </div>

                    {{-- RECENSIONE --}}
                    <div class="md-form mb-4">
                        <label data-error="wrong" data-success="right" for="rv_content">Recensione</label>
                        <textarea name="rv_content" id="rv_content" cols="54" rows="3" required
                            minlength="10"></textarea>
                    </div>

                    {{-- USER ID --}}
                    <div class="md-form mb-4">
                        <input type="hidden" class="form-control validate" name="user_id" value="{{$user->id}}">
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn custom-button">Invia recensione</button>
                </div>
            </div>
        </div>
    </form>

</div>

@endsection
