<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentProviderRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_method_name',
        'website',
        'event_id',
        'company_id',
        'status'  
    ];

    public function event() {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function company() {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
