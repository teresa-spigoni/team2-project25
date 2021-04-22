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

        <form method="post" id="payment-form" action="#">
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
    </div>
</div>

<script src="https://js.braintreegateway.com/web/dropin/1.27.0/js/dropin.min.js"></script>
<script>
    var form = document.querySelector('#payment-form');
    var client_token = "{{$token}}";

    braintree.dropin.create({
      authorization: client_token,
      selector: '#bt-dropin',
      paypal: {
        flow: 'vault'
      }
    }, function (createErr, instance) {
      if (createErr) {
        console.log('Create Error', createErr);
        return;
      }
      form.addEventListener('submit', function (event) {
        event.preventDefault();

        instance.requestPaymentMethod(function (err, payload) {
          if (err) {
            console.log('Request Payment Method Error', err);
            return;
          }

          // Add the nonce to the form and submit
          document.querySelector('#nonce').value = payload.nonce;
          form.submit();
        });
      });
    });
</script>


@endsection