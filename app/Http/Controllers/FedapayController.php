<?php

namespace App\Http\Controllers;

use App\Models\Classement;
use App\Models\Transation;
use Carbon\Carbon;
use FedaPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Paiement;

class FedapayController extends Controller
{
    public function __construct()
    {

        \FedaPay\FedaPay::setApiKey(env("FEDAPAY_PRIVATE_KEY"));

        /* Specify whenever you are willing to execute your request in test or live mode */
        \FedaPay\FedaPay::setEnvironment(env('FEDAPAY_ENVIRONMENT'));
    }


    public function make_payment(Request $request, $classement_id)
    {
        $credentials = $request->validate([
            'telephone' => ['required',],
            'email' => ['required'],
        ]);


        try {
            $transaction = \FedaPay\Transaction::create(array(
                "description" => "Transaction for ",
                "amount" => "100",
                "currency" => ["iso" => "XOF"],
                "callback_url" => url('/payment/callback/?classement_id='), // tu peux envoyer l'id de l'etudiant cet url
                "customer" => [
                    "firstname" => "Joe",
                    "lastname" => "Biden",
                    "email" => "coachjuste@gmail.com",
                    "phone_number" => [
                        "number" => "64000001",
                        "country" => "bj"
                    ]
                ]
            ));
            $token = $transaction->generateToken();

            // ENregistrer  les transactions
            // TransactionVerification::create([
            //     'transaction_id'=>$transaction->id
            // ]);
            return redirect()->away($token->url);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }


    }


    public function callback(Request $request)
    {
        dd($request);
        $transaction_id = $request->input('id');
        $classement_id = $request->input('classement_id');
        $message = '';
        // test


        // // test
        try {
            $transaction = FedaPay\Transaction::retrieve($transaction_id);
            // dd($transaction);
            // $status='success';
            switch ($transaction->status) {
                case 'approved':
                    $message = 'Transaction approuvée.';

                    Paiement::create([
                        "classement_id" => $classement_id,
                        "reference" => $transaction->reference??"reference",
                        "montant" => 100
                    ]);
                            $message = 'Paiement effectué avec succès.';
                    return redirect(url('payementsucces/'))->with(['success' => $message]);

                    // break;
                case 'cancelled':
                    $message = 'Transaction annulée.';
                    return redirect(url('payementsucces/'))->with(['error' => $message]);

                    // break;
                case 'failed':
                    $message = 'Transaction echouée.';
                    return redirect(url('payementsucces/'))->with(['error' => $message]);
                    // break;
                case 'pending':
                    $message = 'Transaction avec une erreur.';
                    return redirect(url('payementsucces/' ))->with(['error' => $message]);
                    // break;
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            // dd($e->getMessage());
           return redirect(url('payementsucces/' ))->with(['error' => $message]);
        }

        return redirect(url('payementsucces/' ))->with(['error' => $message]);
    }
    // fin fedapay

    public function payementsucces()
    {
        return view('vitrine.payementsucces');
    }

    public function callback_kkiapay($classement_id, Request $request)
    {
        $transaction_id = $request->input('transaction_id');
        $message = '';
        $classement = Classement::findOrFail($classement_id);
        // test
        // // test
        try {
                $kkiapay = new \Kkiapay\Kkiapay(env('KKIAPAY_PUBLIC_KEY'),
                                env('KKIAPAY_PRIVATE_KEY'),
                                env('KKIAPAY_SECRET_KEY'),
                                env('KKIAPAY_ENVIRONMENT'));

                $transaction=$kkiapay->verifyTransaction($transaction_id);
            // $status='success';
            switch ($transaction->status) {
                case 'SUCCESS':
                    $message = 'Transaction approuvée.';
                    Paiement::create([
                        "classement_id" => $classement_id,
                        "reference" => $transaction->transactionId??"reference",
                        "montant" => 100
                    ]);
                            $message = 'Paiement effectué avec succès.';
                    return redirect(url('payementsucces/'))->with(['success' => $message]);
                    // break;
                case 'FAILED':
                    $message = 'Transaction annulée.';
                    return redirect(url('payementsucces/'))->with(['error' => $message]);

                    // break;
                case 'INSUFFICIENT_FUND':
                    $message = 'Fond insuffisant';
                    return redirect(url('payementsucces/'))->with(['error' => $message]);
                    // break;
                default :
                    $message = 'Une erreur s\'est prouite';
                        return redirect(url('payementsucces/'))->with(['error' => $message]);
                        // break;
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            // dd($e->getMessage());
            return redirect('payementsucces/')->with('error', $e->getMessage());
        }

       return redirect(url('payementsucces/'))->with(['error' => $message]);

    }

}
