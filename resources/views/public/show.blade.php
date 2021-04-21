@extends('layouts.app')
@section('title', 'Show')
@section('content')
    <h1 class="custom-h1">Pagina Dottore</h1>
    <button class="btn custom-button" @click="historyBack('{{ $spec }}')">
        Torna all'elenco
    </button>

    <div class="card doctor-card">
        <div class="card-body">
            <button class="btn custom-button b-absolute" data-toggle="modal" data-target="#modalMessage">
                Manda un messaggio
            </button>
            <img src="{{ asset($user->profile_image) }}">
            <h2 class="card-title"><i class="fas fa-user-md" style="color: #32bea6"></i> {{ $user->name }}
                {{ $user->lastname }}
            </h2>
            <div class="card-text" id="specs">
                @foreach ($user->specializations as $spec)
                    <h5>&diams; {{ $spec->spec_name }}</h5>
                @endforeach
            </div>
            <hr>
            <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
            <p class="card-text"><strong>Indirizzo:</strong> {{ $user->address }}</p>
            <a class="card-text" href="">Curriculum</a>
            <h3>Servizi disponibili del dottore:</h3>
            @foreach ($user->services as $service)
                <hr>
                <div class="card-text"><strong>Prestazione: </strong>{{ $service->service_type }}</div>
                <div class="card-text"><strong>Indirizzo: </strong>{{ $service->service_address }}</div>
                <div class="card-text"><strong>Prezzo: </strong>{{ $service->service_price }}</div>
            @endforeach
        </div>
        <hr>
    </div>

    </div>
    <hr>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Scrivi una recensione') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('review') }}">
                        @csrf
                        @method('POST')
                        {{-- nome --}}
                        <div class="form-group row">
                            <label for="rv_name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="rv_name" type="text" class="form-control @error('rv_name') is-invalid @enderror"
                                    name="rv_name" value="{{ old('rv_name') }}" required autocomplete="rv_name"
                                    autofocus>

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
                                    class="form-control @error('rv_lastname') is-invalid @enderror" name="rv_lastname"
                                    value="{{ old('rv_lastname') }}" required autocomplete="rv_lastname" autofocus>

                                @error('rv_lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- voto --}}
                        <div class="form-group row">
                            <label for="rv_vote" class="col-md-4 col-form-label text-md-right">{{ __('Voto') }}</label>

                            <div class="col-md-6">
                                <input id="rv_vote" type="number"
                                    class="form-control @error('rv_vote') is-invalid @enderror" name="rv_vote"
                                    value="{{ old('rv_vote') }}" required autocomplete="rv_vote" autofocus>

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
                                    value="{{ old('rv_title') }}" required autocomplete="rv_title" autofocus>

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
                                <textarea id="rv_content" class="form-control @error('rv_content') is-invalid @enderror"
                                    name="rv_content" value="{{ old('rv_content') }}" required autocomplete="rv_content"
                                    autofocus></textarea>

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
                                <input id="user_id" type="text" class="form-control @error('user_id') is-invalid @enderror"
                                    name="user_id" value="{{ $user->id }}" required autocomplete="user_id" autofocus>

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
    <br><br>

    <hr>


    @foreach ($reviews as $review)
        @if ($review->user_id === $user->id)
            <div>
                @for ($i = 0; $i < $review->rv_vote; $i++)
                    <i class="fas fa-star"></i>
                @endfor
            </div>

            <h3>{{ $review->rv_title }}</h3> <br>
            <p style="width:250px">{{ $review->rv_content }}</p> <br>
            <h5>{{ $review->rv_name }} {{ $review->rv_lastname }}</h5>
            <hr>
        @endif

    @endforeach
    </div>
    <div class="modal fade" id="modalMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form action="{{ route('saveMessage', ['user' => Auth::user(), 'spec' => $spec]) }}" method="post">
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
                        <div class="md-form mb-5">
                            <label data-error="wrong" data-success="right" for="msg_name">Nome</label>
                            <input type="text" class="form-control validate" name="msg_name">
                        </div>

                        <div class="md-form mb-4">
                            <label data-error="wrong" data-success="right" for="msg_lastname">Cognome</label>
                            <input type="text" class="form-control validate" name="msg_lastname">
                        </div>

                        <div class="md-form mb-4">
                            <label data-error="wrong" data-success="right" for="msg_email">E-Mail</label>
                            <input type="text" class="form-control validate" name="msg_email">
                        </div>

                        <div class="md-form mb-4">
                            <label data-error="wrong" data-success="right" for="msg_phone_number">Numero di telefono</label>
                            <input type="text" class="form-control validate" name="msg_phone_number">
                        </div>
                        <div class="md-form mb-4">
                            <label data-error="wrong" data-success="right" for="msg_content">Messaggio</label>
                            <textarea name="msg_content" id="msg_content" cols="57" rows="3"></textarea>
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
