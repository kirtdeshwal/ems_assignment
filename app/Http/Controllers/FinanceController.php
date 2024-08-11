<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\PaymentMethod;
use App\Models\Company;
use App\Models\EventPayment;
use App\Models\PaymentProviderRequest;

class FinanceController extends Controller
{
    /**
     * Show all events on dashboard.
     */
    public function index() {
        $events = Event::orderBy('created_at', 'desc')->get();
        $eventPayments = EventPayment::orderBy('created_at', 'desc')->get();
        $events_with_payments = Event::has('event_payment')->get();
        $payment_methods = PaymentMethod::all();
        $companies = Company::all();
        $provider_requests = PaymentProviderRequest::orderBy('created_at', 'desc')->get();
        return view('finance.index', compact('events', 'payment_methods', 'companies', 'eventPayments', 'provider_requests'));
    }
}
