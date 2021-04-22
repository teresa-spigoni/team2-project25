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
        <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
        <p class="card-text"><strong>Indirizzo:</strong> {{ $user->address }}</p>
        <button class="btn custom-button"><a href="{{ isset($user->curriculum) ? asset($user->curriculum) : '' }}"
                type="application/pdf" width="600px" height="300px"><i class="fas fa-file-pdf"
                    style="margin-right: 10px; font-size: 30px"></i>Curriculum</a></button>

        {{-- Prestazioni --}}
        <h3 style="margin-top: 20px">Prestazioni e prezzi:</h3>
        <hr>
        @foreach ($user->services as $service)
        <div class="card-text"><strong>Prestazione: </strong>{{ $service->service_type }}</div>
        <div class="card-text"><strong>Indirizzo: </strong>{{ $service->service_address }}</div>
        <div class="card-text"><strong>Prezzo: </strong>{{ $service->service_price }}</div>
        <hr>
        @endforeach

        {{-- Form per scrivere la recensione --}}
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="margin-top: 40px">
                    <div class="card-header">{{ __('Scrivi una recensione') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('review') }}">
                            @csrf
                            @method('POST')
                            {{-- nome --}}
                            <div class="form-group row">
                                <label for="rv_name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                                <div class="col-md-6">
                                    <input id="rv_name" type="text"
                                        class="form-control @error('rv_name') is-invalid @enderror" name="rv_name"
                                        value="{{ old('rv_name') }}" autocomplete="rv_name" autofocus minlength="3"
                                        maxlength="50">

                                    @error('rv_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- cognome --}}
                            <div class="form-group row">
                                <label for="rv_lastname"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Cognome') }}</label>

                                <div class="col-md-6">
                                    <input id="rv_lastname" type="text"
                                        class="form-control @error('rv_lastname') is-invalid @enderror"
                                        name="rv_lastname" value="{{ old('rv_lastname') }}" autocomplete="rv_lastname"
                                        autofocus minlength="3" maxlength="50">

                                    @error('rv_lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- voto --}}
                            <div class="form-group row">
                                <label for="rv_vote"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Voto') }}</label>

                                <div class="col-md-6">
                                    <input id="rv_vote" type="number"
                                        class="form-control @error('rv_vote') is-invalid @enderror" name="rv_vote"
                                        value="{{ old('rv_vote') }}" required autocomplete="rv_vote" autofocus min="1"
                                        max="5">

                                    @error('rv_vote')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- titolo --}}
                            <div class="form-group row">
                                <label for="rv_title"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Titolo') }}</label>

                                <div class="col-md-6">
                                    <input id="rv_title" type="text"
                                        class="form-control @error('rv_title') is-invalid @enderror" name="rv_title"
                                        value="{{ old('rv_title') }}" required autocomplete="rv_title" autofocus
                                        minlength="5" maxlength="20">

                                    @error('rv_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- contenuto --}}
                            <div class="form-group row">
                                <label for="rv_content"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Contenuto') }}</label>

                                <div class="col-md-6">
                                    <textarea id="rv_content"
                                        class="form-control @error('rv_content') is-invalid @enderror" name="rv_content"
                                        value="{{ old('rv_content') }}" required autocomplete="rv_content" autofocus
                                        minlength="10"></textarea>

                                    @error('rv_content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- user id --}}
                            <div id="user_id" class="form-group row">
                                <label for="user_id"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Dottore') }}</label>

                                <div class="col-md-6">
                                    <input id="user_id" type="text"
                                        class="form-control @error('user_id') is-invalid @enderror" name="user_id"
                                        value="{{ $user->id }}" required autocomplete="user_id" autofocus>

                                    @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- submit --}}
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn custom-button">
                                        {{ __('Invia recensione') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br><br>

        {{-- Recensioni --}}
        <h2>Recensioni</h2>
        <hr>
        @foreach ($reviews as $review)
        @if ($review->user_id === $user->id)
        <div>
            @for ($i = 0; $i < $review->rv_vote; $i++)
                <i class="fas fa-star" style="color: orange"></i>
                @endfor
        </div>
        <h3>{{ $review->rv_title }}</h3> <br>
        <p style="width:250px">{{ $review->rv_content }}</p> <br>
        <h5>{{ $review->rv_name }} {{ $review->rv_lastname }}</h5>
        <hr>
        @endif
        @endforeach
    </div>
</div>

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

                    {{-- MEDDAGGIO --}}
                    <div class="md-form mb-4">
                        <label data-error="wrong" data-success="right" for="msg_content">Messaggio</label>
                        <textarea name="msg_content" id="msg_content" cols="57" rows="3" required
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

@endsection
