<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [ 'name', 'location', 'date', 'description' ];

    public function event_payment() {
        return $this->hasMany(EventPayment::class, 'event_id');
    }

    public function payment_provider_request() {
        return $this->hasMany(PaymentProviderRequest::class, 'event_id');
    }
}
