@extends('layouts.app')
@section('title', 'Show')
@section('content')

    @if (session('success_message'))
        <div class="alert alert-success">
            {{ session('success_message') }}
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h5>Sponsorizzazioni</h5>
        @foreach($sponsorships as $sponsor) 
        <div> 
            <div>nome: {{$sponsor->sponsor_name}} </div>
            <div>durata: {{$sponsor->sponsor_duration}} ore</div>
            <div>prezzo: {{$sponsor->sponsor_price}} €</div>
        </div>
        <hr>
        @endforeach

        <form method="post" id="payment-form" action="{{ url('auth/checkout') }}">
            @csrf
            @method('POST')
            <section>
                <label for="amount">
                    <span class="input-label">Amount</span>
                    <div class="input-wrapper amount-wrapper">
                        <input id="amount" name="amount" type="tel" min="1" placeholder="Amount" value="10">
                    </div>
                </label>

                <div class="bt-drop-in-wrapper">
                    <div id="bt-dropin"></div>
                </div>
            </section>

            <input id="nonce" name="payment_method_nonce" type="hidden" />
            <button class="button" type="submit"><span>Test Transaction</span></button>
        </form>

@endsection