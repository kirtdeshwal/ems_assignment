<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'payment_method_id',
        'company_id',
        'vat_rate'  
    ];

    public function event() {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function payment_method() {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function company() {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
