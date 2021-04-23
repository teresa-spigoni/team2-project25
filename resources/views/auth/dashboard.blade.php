@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <img src="{{ Auth::user()->profile_image }}" class="card-img-top custom-img user_img" alt="profile-pic"
                    style="margin: 20px 0 10px 20px">

                {{-- <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
            </div>

            {{ __('You are logged in!') }} <br><br>
            <button class="btn custom-button">
                <a href="{{ route('edit', ['user' => Auth::user()]) }}">
                    fbicjw
                </a>
            </button>
            <button class="btn custom-button">
                <a href="{{ route('messages', ['user' => Auth::user()]) }}">Visualizza i tuoi messaggi</a>
            </button>
            <button class="btn custom-button" data-toggle="modal" data-target="#modalService">
                Aggiungi una prestazione
            </button>
            <button class="btn custom-button">
                <a href="{{ route('buySponsorship', ['user' => Auth::user()]) }}">Acquista
                    sponsorizzazione</a>
                <a href="{{ route('message', ['user' => Auth::user()]) }}">
                    Visualizza messagi
                </a>
            </button>
            <form action="{{ route('destroy', ['user' => Auth::user()]) }}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn custom-button" type="submit">Elimina account</button>
            </form>
            @endif
        </div> --}}




        {{-- pulsante per modificare i dati --}}
        {{-- <button class="btn custom-button">
                    <a href="{{ route('edit', ['user' => Auth::user()]) }}">
        <i class="fas fa-user-edit"></i>
        Modifica i tuoi dati
        </a>
        </button> --}}




        <div class="card-body">
            <strong style="font-size: 22px">{{ Auth::user()->name }} {{ Auth::user()->lastname }} <i
                    class="fas fa-circle" style="color: green; font-size: 10px; vertical-align:middle"></i></strong>
            <br>
            {{ __('Logged') }} <br><br>

            <div class="card-text" id="specs">
                @foreach (Auth::user()->specializations as $spec)
                <h5>&diams; {{ $spec->spec_name }}</h5>
                @endforeach
            </div>

            @php
            date_default_timezone_set('Europe/Rome');
            $currentDate = date("Y-m-d H:i:s");
            $numSponsAttive = 0;
            foreach (Auth::user()->sponsorships as $sponsor) {
            if ($sponsor->pivot->expiration_time > $currentDate) {
            $numSponsAttive += 1;
            }
            }
            @endphp

            @if ($numSponsAttive > 0)
            <h4>Sei sponsorizzato</h4>
            @else
            <h4>Non sei sponsorizzato</h4>
            @endif
            <br>
            <hr>
            <h3>Prestazioni:</h3>
            @foreach (Auth::user()->services as $service)
            <div class="card" style="width: 200px; display: inline-block; padding:20px">
                <h5>{{ $service->service_type }}</h5>
                €{{ $service->service_price }}
            </div>
            @endforeach
            <br><br>
            <hr>

            <button class="btn custom-button" data-toggle="modal" data-target="#modalEdit">
                Modifica i tuoi dati
            </button>

            {{-- pulsante per visualizzare i messaggi --}}
            <button class="btn custom-button">
                <a href="{{ route('messages', ['user' => Auth::user()]) }}"><i class="fas fa-comments"></i>
                    Visualizza messaggi</a>
            </button>

            {{-- pulsante per aggiungere una prestazione --}}
            <button class="btn custom-button" data-toggle="modal" data-target="#modalService">
                Aggiungi prestazione
            </button>

            {{-- pulsante per acquistare una sponsorizzazione --}}
            <button class="btn custom-button">
                <a href="{{ route('buySponsorship', ['user' => Auth::user()]) }}"><i class="fas fa-shopping-cart"></i>
                    Acquista sponsorizzazione</a>
            </button>

            {{-- pulsante che elimina l'account --}}
            <form action="{{ route('destroy', ['user' => Auth::user()]) }}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn custom-button delete" type="submit"><i class="fas fa-trash-alt"></i>
                    Elimina account
                </button>
            </form>
        </div>

    </div>
</div>
</div>


{{-- Modale per la prestazione --}}
<div class="modal fade" id="modalService" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="{{ route('newService', ['user' => Auth::user()]) }}" method="post">
        @csrf
        @method('POST')
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Nuova prestazione</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div class="md-form mb-5">
                        <label data-error="wrong" data-success="right" for="service_type">Nome
                            prestazione</label>
                        <input type="text" class="form-control validate" name="service_type" required minlength="5">
                    </div>

                    <div class="md-form mb-4">
                        <label data-error="wrong" data-success="right" for="service_address">Indirizzo
                            Prestazione</label>
                        <input type="text" class="form-control validate" name="service_address" required minlength="15">
                    </div>

                    <div class="md-form mb-4">
                        <label data-error="wrong" data-success="right" for="service_price">Prezzo
                            Prestazione</label>
                        <input type="number" step="0.01" class="form-control validate" name="service_price" min="10.00"
                            required>
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn custom-button">Crea prestazione</button>
                </div>
            </div>
        </div>
    </form>

</div>


{{-- Modale per modificare i dati --}}
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="{{ route('update', ['user' => Auth::user()]) }}" method="post">
        @csrf
        @method('PUT')
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">I tuoi dati</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">

                    <div class="md-form mb-5">
                        <label data-error="wrong" data-success="right" for="name">
                            Nome
                        </label>
                        <input type="text" class="form-control validate" name="name" required minlength="3"
                            maxlength="50" value="{{Auth::user()->name}}">
                    </div>

                    <div class="md-form mb-4">
                        <label data-error="wrong" data-success="right" for="lastname">
                            Cognome
                        </label>
                        <input type="text" class="form-control validate" name="lastname" required minlength="3"
                            maxlength="50" value="{{Auth::user()->lastname}}">
                    </div>

                    <div class="form-group">
                        <label for="specializations">Specializzazione</label>
                        <select class="form-control" id="specializations" name="specializations[]" multiple required>
                            <option value="">nessuno</option>
                            @foreach ($specs as $spec)
                            <option value="{{ $spec->id }}" @foreach (Auth::user()->specializations as $userSpec)
                                @if($userSpec->id === $spec->id)
                                selected
                                @endif
                                @endforeach
                                >{{ $spec->spec_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md-form mb-4">
                        <label data-error="wrong" data-success="right" for="email">
                            Email
                        </label>
                        <input type="email" class="form-control validate" name="email" required
                            value="{{Auth::user()->email}}">
                    </div>

                    <div class="md-form mb-4">
                        <label data-error="wrong" data-success="right" for="address">
                            Indirizzo
                        </label>
                        <input type="text" class="form-control validate" name="address" minlength="15" required
                            value="{{Auth::user()->address}}">
                    </div>

                    <div class="md-form mb-4">
                        <label data-error="wrong" data-success="right" for="phone_number">
                            Numero di telefono
                        </label>
                        <input type="text" class="form-control validate" name="phone_number" minlength="9"
                            maxlength="10" value="{{Auth::user()->phone_number}}">
                    </div>

                    <div class="md-form mb-4">
                        <label data-error="wrong" data-success="right" for="sprofile_image">
                            Foto profilo
                        </label>
                        <input type="file" class="form-control validate" name="profile_image"
                            value="{{Auth::user()->profile_image}}">
                    </div>

                    <div class="md-form mb-4">
                        <label data-error="wrong" data-success="right" for="curriculum">
                            Curriculum
                        </label>
                        <input type="file" class="form-control validate" name="curriculum"
                            value="{{Auth::user()->curriculum}}">
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-right">
                    <button type="submit" class="btn custom-button">Salva</button>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection
