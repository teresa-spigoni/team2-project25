<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree;
use App\Sponsorship;
use App\User;
use DateInterval;
use DateTime;

class PaymentController extends Controller
{
    public function checkout(Request $request, User $user) {
        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey'),
        ]);

        $amount = $request->amount;
        // $nonce = $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => 'fake-valid-nonce',
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            $data=new DateTime("now");
            $realDate =$data->add(DateInterval::createFromDateString('2 hours'));
            $sponsor = Sponsorship::all()->where('sponsor_price', $request->amount)->first();
            $sponId = $sponsor->id;
            $expirationDate = $realDate->add(DateInterval::createFromDateString($sponsor->sponsor_duration . ' hours'));
            $user->sponsorships()->attach($sponId, ['expiration_time' => $expirationDate]);
            return back()->with('success_message', 'Il pagamento è  avvenuto con successo.');
        } else {
            $errorString = "";

            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            return back()->withErrors('Ops, c\'è stato un errore durante il pagamento. Riprova.');

        }

    }
}
