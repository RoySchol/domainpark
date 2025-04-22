<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handle(Request $req)
    {
        $payment = mollie()->payments->get($req->id);

        // Zoek bijhorende bid via sessie of metadata
        $bidId = array_key_last(session('mollie_payment_id', []));
        $bid = Bid::findOrFail($bidId);

        if ($payment->isPaid() && ! $bid->isAccepted) {
            $bid->update(['accepted_at' => now()]);
            // Eventueel: sla domain->buy_now_price of status op
            // en stuur bevestigingsemail
        }

        return response()->noContent();
    }
}

