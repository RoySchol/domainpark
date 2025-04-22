<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BidAcceptanceController extends Controller
{
    public function showAccept(Bid $bid, $token)
    {
        abort_if($bid->accept_token !== $token, 403);

        if ($bid->isAccepted) {
            return view('bids.already_accepted', compact('bid'));
        }

        return view('bids.accept', compact('bid'));
    }

    public function processAccept(Request $req, Bid $bid, $token)
    {
        abort_if($bid->accept_token !== $token, 403);
        if ($bid->isAccepted) {
            return redirect()->route('bids.accept', [$bid, $token])
                             ->with('info','Deze bieding is al geaccepteerd.');
        }

        // Start Mollie-checkout
        $payment = mollie()
            ->payments
            ->create([
                'amount' => [
                    'currency' => 'EUR',
                    'value'    => number_format($bid->amount,2,'.',''),
                ],
                'description' => "Aankoop domein {$bid->domain->name}",
                'redirectUrl' => route('bids.accept.process', [$bid, $token]),
                'webhookUrl'  => route('webhooks.mollie'),
            ]);

        // Sla payment_id tijdelijk op in sessie
        session(["mollie_payment_id.{$bid->id}" => $payment->id]);

        return redirect($payment->getCheckoutUrl(), 303);
    }
}

