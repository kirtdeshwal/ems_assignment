<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentProviderRequest;
use App\Mail\FinanceStatusEmail;
use Illuminate\Support\Facades\Mail;

class PaymentProviderRequestController extends Controller
{
    /**
     * Store a newly created payment provider request in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'payment_method_name' => 'required|string|max:255',
            'website' => 'nullable|url|max:255',
            'event_id' => 'required|exists:events,id',
            'company_id' => 'required|exists:companies,id',
        ]);

        $exists = PaymentProviderRequest::where('event_id', $request->event_id)->where('company_id', $request->company_id)->first();

        if($exists) {
            $exists->payment_method_name = $request->payment_method_name;
            $exists->website = $request->website;
            $exists->save();
            
            $event = $exists->event->name;
            $payment_method = $request->payment_method_name;
            $company = $exists->company->name;
            $message = 'Payment provider request updated successfully';
        } else {
            $paymentProviderRequest = PaymentProviderRequest::create([
                'payment_method_name' => $request->payment_method_name,
                'website' => $request->website,
                'event_id' => $request->event_id,
                'company_id' => $request->company_id,
                'status' => 'pending',
            ]);

            $event = $paymentProviderRequest->event->name;
            $payment_method = $request->payment_method_name;
            $company = $paymentProviderRequest->company->name;
            $message = 'Payment provider request created successfully';
        }

        if($event) {
            $status = $message.'. where event is '.$event.' and payment method is '.$payment_method.' and company is '.$company;
            Mail::to(auth()->user()->email)->send(new FinanceStatusEmail($status));
        }

        return response()->json([
            'status' => true,
            'message' => message
        ], 201);
    }



    /**
     * Update the status of a payment provider request.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $paymentProviderRequest = PaymentProviderRequest::findOrFail($id);
        $paymentProviderRequest->update(['status' => $request->status]);


        return response()->json(['message' => 'Payment provider request status updated successfully.']);
    }



    /**
     * Retrieve a list of available payment methods.
     */
    public function getPaymentMethods()
    {
        $paymentMethods = PaymentMethod::all();
        return response()->json($paymentMethods);
    }



    /**
     * Retrieve a list of companies.
     */
    public function getCompanies()
    {
        $companies = Company::all();
        return response()->json($companies);
    }
}
