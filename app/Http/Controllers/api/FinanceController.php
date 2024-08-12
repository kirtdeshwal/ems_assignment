<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\PaymentMethod;
use App\Models\Company;
use App\Models\EventPayment;
use App\Models\PaymentProviderRequest;

class FinanceController extends Controller
{
    public function index() {
        $events = Event::orderBy('created_at', 'desc')->get();
        return response()->json($events);
    }

    public function payment_methods() {
        $payment_methods = PaymentMethod::all();
        return response()->json($payment_methods);
    }

    public function companies() {
        $companies = Company::all();
        return response()->json($companies);
    }

    public function payment_provider_requests() {
        $payment_provider_requests = PaymentProviderRequest::all();
        return response()->json($payment_provider_requests);
    }
}
