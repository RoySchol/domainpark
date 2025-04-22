<?php
namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Bid;
use App\Mail\NewBidPlaced;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BidController extends Controller
{
    public function store(Request $req, Domain $domain)
    {
        $req->validate([
            'amount' => ['required','numeric','min:'.$domain->minimum_bid],
            'user_email' => ['nullable','email'],
        ]);

        $bid = Bid::create([
            'domain_id'  => $domain->id,
            'amount'     => $req->amount,
            'user_email' => $req->user_email,
        ]);

        // Verstuur melding naar admin
        Mail::to(config('mail.from.address'))
            ->queue(new NewBidPlaced($bid));

        return back()->with('success','Bod geplaatst! Je hoort van ons per e-mail.');
    }
}

