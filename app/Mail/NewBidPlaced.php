<?php
namespace App\Mail;

use App\Models\Bid;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewBidPlaced extends Mailable
{
    use Queueable, SerializesModels;

    public Bid $bid;

    public function __construct(Bid $bid)
    {
        $this->bid = $bid;
    }

    public function build()
    {
        return $this->subject("Nieuw bod op domein {$this->bid->domain->name}")
                    ->markdown('emails.bids.new')
                    ->with([
                        'bid'   => $this->bid,
                        'domain'=> $this->bid->domain,
                        'acceptUrl' => route('bids.accept', [
                            'bid'   => $this->bid->id,
                            'token' => $this->bid->accept_token
                        ]),
                    ]);
    }
}

