@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card dash-card">
                    @php
                        date_default_timezone_set('Europe/Rome');
                        $currentDate = date('Y-m-d H:i:s');
                        $numSponsAttive = 0;
                        foreach (Auth::user()->sponsorships as $sponsor) {
                            if ($sponsor->pivot->expiration_time > $currentDate) {
                                $numSponsAttive += 1;
                            }
                        }
                    @endphp
                    <img src="{{ Auth::user()->profile_image }}" class="user-image inline-b" alt="profile-pic">
                    <div class="card-body">
                        <strong style="font-size: 22px">{{ Auth::user()->name }} {{ Auth::user()->lastname }} <i
                                class="fas fa-circle logged"></i></strong>
                        @if ($numSponsAttive > 0)
                            <br>
                            <div class="sponsor-check">
                                <i class="fas fa-check"></i>
                                Piano {{ $sponsor->sponsor_name }} attivo.
                            </div>
                        @endif
                        <br>
                        <div class="card-text" id="specs">
                            @foreach (Auth::user()->specializations as $spec)
                                <h6>{{ $spec->spec_name }}</h6>
                            @endforeach
                        </div>
                        @if (count(Auth::user()->services) > 0)
                            <hr>
                            <h3 class="custom-h1">Prestazioni:</h3>
                            @foreach (Auth::user()->services as $service)
                                <div class="card inline-b dash-services">
                                    <h5><strong>{{ $service->service_type }}</strong></h5>
                                    {{ $service->service_address }}
                                    <br>
                                    €{{ $service->service_price }}
                                </div>
                            @endforeach
                        @endif
                        <br><br>
                        <hr>

                        {{-- pulsante per modificare i dati --}}
                        <button class="btn custom-button">
                            <a href="{{ route('edit', ['user' => Auth::user()]) }}">
                                <i class="fas fa-user-edit"></i>
                                Modifica i tuoi dati
                            </a>
                        </button>

                        {{-- pulsante per visualizzare i messaggi --}}
                        <button class="btn custom-button">
                            <a href="{{ route('messages', ['user' => Auth::user()]) }}">
                                <i class="fas fa-comments"></i>
                                Visualizza messaggi
                            </a>
                        </button>

                        {{-- pulsante per aggiungere una prestazione --}}
                        <button class="btn custom-button" data-toggle="modal" data-target="#modalService">
                            <i class="fas fa-plus"></i>
                            Aggiungi prestazione
                        </button>

                        {{-- pulsante per acquistare una sponsorizzazione --}}
                        @if (count(Auth::user()->sponsorships) > 0)
                            <button class="btn custom-button" data-toggle="modal" data-target="#modalSponsor">
                                <i class="fas fa-shopping-cart"></i>
                                Dettagli sponsorizzazione
                            </button>
                        @else
                            <button class="btn custom-button">
                                <a href="{{ route('buySponsorship', ['user' => Auth::user()]) }}">
                                    <i class="fas fa-shopping-cart"></i>
                                    Acquista sponsorizzazione
                                </a>
                            </button>
                        @endif

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

        {{-- Modale per la sponsorizzazione --}}
        @if (count(Auth::user()->sponsorships) > 0)
            <div class="modal fade" id="modalSponsor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h4 class="modal-title w-100 font-weight-bold">Dettagli sponsorizzazione</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body mx-3">
                            <div>Piano: {{ $sponsor->sponsor_name }}</div>
                            <div>Attivato in data: {{ substr($sponsor->pivot->created_at, 0, 10) }} alle
                                {{ substr($sponsor->pivot->created_at, 11, 5) }}</div>
                            <div>Scadrà il: {{ substr($sponsor->pivot->expiration_time, 0, 10) }} alle
                                {{ substr($sponsor->pivot->expiration_time, 11, 5) }}</div>

                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Modale per la prestazione --}}
        <div class="modal fade" id="modalService" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <form action="{{ route('newService', ['user' => Auth::user()]) }}" method="post" class="needs-validation"
                novalidate>
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
                                <div class="invalid-feedback">Inserisci un nome.</div>
                            </div>
                            <div class="md-form mb-4">
                                <label data-error="wrong" data-success="right" for="service_address">Indirizzo
                                    Prestazione</label>
                                <input type="text" class="form-control validate" name="service_address" required
                                    minlength="15">
                                <div class="invalid-feedback">Inserisci l'indirizzo.</div>
                            </div>
                            <div class="md-form mb-4">
                                <label data-error="wrong" data-success="right" for="service_price">Prezzo
                                    Prestazione</label>
                                <input type="number" step="0.01" class="form-control validate" name="service_price"
                                    min="10.00" required>
                                <div class="invalid-feedback">Inserisci il prezzo.</div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn custom-button">Crea prestazione</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endsection
