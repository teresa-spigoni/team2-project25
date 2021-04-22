@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <img src="{{ Auth::user()->profile_image }}" class="card-img-top custom-img user_img"
                        alt="profile-pic" style="margin: 20px 0 10px 20px">

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            <strong style="font-size: 18px">{{ Auth::user()->name }}
                                {{ Auth::user()->lastname }}</strong>
                            <br>
                            {{ __('You are logged in!') }} <br><br>
                            <button class="btn custom-button">
                                <a href="{{ route('edit', ['user' => Auth::user()]) }}">
                                    Modifica i tuoi dati
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
                    </div>
                    @endif
                    <strong style="font-size: 22px">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</strong>
                    <br>
                    {{ __('Logged') }} <br><br>


                    <button class="btn custom-button">
                        <a href="{{ route('edit', ['user' => Auth::user()]) }}"><i class="fas fa-user-edit"></i> Modifica
                            i
                            tuoi dati</a>
                    </button>
                    <button class="btn custom-button">
                        <a href="{{ route('messages', ['user' => Auth::user()]) }}"><i class="fas fa-comments"></i>
                            Visualizza messaggi</a>
                    </button>
                    <button class="btn custom-button" data-toggle="modal" data-target="#modalService">
                        Aggiungi prestazione
                    </button>
                    <button class="btn custom-button">
                        <a href="{{ route('buySponsorship', ['user' => Auth::user()]) }}"><i
                                class="fas fa-shopping-cart"></i> Acquista sponsorizzazione</a>
                    </button>
                    <form action="{{ route('destroy', ['user' => Auth::user()]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn custom-button delete" type="submit"><i class="fas fa-trash-alt"></i> Elimina
                            account</button>
                    </form>
                </div>
            </div>
        </div>


        {{-- Modale --}}
        <div class="modal fade" id="modalService" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
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
                                <input type="text" class="form-control validate" name="service_type">
                            </div>

                            <div class="md-form mb-4">
                                <label data-error="wrong" data-success="right" for="service_address">Indirizzo</label>
                                <input type="text" class="form-control validate" name="service_address">
                            </div>

                            <div class="md-form mb-4">
                                <label data-error="wrong" data-success="right" for="service_price">Prezzo</label>
                                <input type="number" step="0.01" class="form-control validate" name="service_price">
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
