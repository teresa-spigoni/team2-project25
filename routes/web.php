<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Auth::routes();

Route::get('/', 'UserController@home')->name('homepage');
Route::get('/home', 'HomeController@index')->name('dashboard');
Route::get('/doctors', 'UserController@toIndex')->name('toIndex');
Route::get('/doctors/{user}/{spec}', 'UserController@show')->name('show');
Route::get('/create', 'UserController@create')->name('create');
Route::get('/doctors/newmessage/{user}', 'UserController@newMessage')->name('newMessage');
Route::post('/doctors/{user}', 'UserController@saveMessage')->name('saveMessage');
Route::post('/review', 'ReviewController@create')->name('review');

Route::prefix('auth')
    ->namespace('Auth')
    ->middleware('auth')
    ->group(function () {
        Route::post('/checkout', function (Request $request) {
            $gateway = new Braintree\Gateway([
                'environment' => config('services.braintree.environment'),
                'merchantId' => config('services.braintree.merchantId'),
                'publicKey' => config('services.braintree.publicKey'),
                'privateKey' => config('services.braintree.privateKey'),
            ]);
    
            $amount = $request->amount;
            $nonce = $request->payment_method_nonce;

            $result = $gateway->transaction()->sale([
                'amount' => $amount,
                'paymentMethodNonce' => 'fake-valid-nonce',
                'options' => [
                    'submitForSettlement' => true
                ]
            ]);

            if ($result->success) {
                $transaction = $result->transaction;
                // header("Location: " . $baseUrl . "transaction.php?id=" . $transaction->id);
                return back()->with('success_message', 'Il pagamento è  avvenuto con successo.');
            } else {
                $errorString = "";

                foreach ($result->errors->deepAll() as $error) {
                    $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
                }

                // $_SESSION["errors"] = $errorString;
                // header("Location: " . $baseUrl . "index.php");
                return back()->withErrors('Ops, c\'è stato un errore durante il pagamento. Riprova.');
                
            }
        });
        Route::get('/hosted', function () {
            $gateway = new Braintree\Gateway([
                'environment' => config('services.braintree.environment'),
                'merchantId' => config('services.braintree.merchantId'),
                'publicKey' => config('services.braintree.publicKey'),
                'privateKey' => config('services.braintree.privateKey')
            ]);
        
            $token = $gateway->ClientToken()->generate();
        
            return view('hosted', [
                'token' => $token
            ]);
        });
        Route::get('edit/{user}', 'PrivateUserController@edit')->name('edit');
        Route::put('update/{user}', 'PrivateUserController@update')->name('update');
        Route::delete('destroy/{user}', 'PrivateUserController@destroy')->name('destroy');
        Route::get('messages/{user}', 'PrivateUserController@showMessages')->name('messages');
        Route::get('sponsorships/{user}', 'SponsorshipController@buySponsorship')->name('buySponsorship');
        Route::post('service/{user}', 'PrivateUserController@newService')->name('newService');
    });
