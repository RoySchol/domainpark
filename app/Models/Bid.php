<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Bid extends Model
{
    protected $fillable = ['domain_id','user_email','amount','accept_token'];

    protected $dates = ['accepted_at'];

    protected static function booted()
    {
        static::creating(function ($bid) {
            $bid->accept_token = Str::uuid();
        });
    }

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }

    public function getIsAcceptedAttribute()
    {
        return ! is_null($this->accepted_at);
    }
}
