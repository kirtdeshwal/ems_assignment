<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventPayment;
use App\Mail\FinanceStatusEmail;
use Illuminate\Support\Facades\Mail;

class EventPaymentController extends Controller
{
    /**
     * Store a newly created event payment configuration in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'company_id' => 'required|exists:companies,id',
            'vat_rate' => 'required|numeric|min:0',
        ]);

        $exists = EventPayment::where('event_id', $request->event_id)->where('company_id', $request->company_id)->first();

        if($exists) {
            $exists->payment_method_id = $request->payment_method_id;
            $exists->vat_rate = $request->vat_rate;
            $exists->save();
            $company = $exists->company->name;
            $event = $exists->event->name;
            $message = 'Event payment updated successfully';
        } else {
            $eventPayment = EventPayment::create([
                'event_id' => $request->event_id,
                'payment_method_id' => $request->payment_method_id,
                'company_id' => $request->company_id,
                'vat_rate' => $request->vat_rate,
            ]);

            $company = $eventPayment->company->name;
            $event = $eventPayment->event->name;
            $message = 'Event payment created successfully';
        }


        if($event) {
            $status = $message.'. where event is '.$event.' and company is '.$comapany;
            Mail::to(auth()->user()->email)->send(new FinanceStatusEmail($status));
        }

        return response()->json([
            'status' => true,
            'message' => $message
        ], 201);
    }



    /**
     * Update the specified event payment configuration in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'payment_method_id' => 'required|exists:payment_methods,id',
            'company_id' => 'required|exists:companies,id',
            'vat_rate' => 'required|numeric|min:0',
        ]);

        $eventPayment = EventPayment::findOrFail($id);

        $company = $eventPayment->company->name;
        if($eventPayment) {
            $event = $eventPayment->event->name;
        } else {
            $event = null;
        }
        $eventPayment->update([
            'payment_method_id' => $request->payment_method_id,
            'company_id' => $request->company_id,
            'vat_rate' => $request->vat_rate,
        ]);

        if($event) {
            $status = 'Payment method for the event '.$event.' has been updated for comapany '.$company;
            Mail::to(auth()->user()->email)->send(new FinanceStatusEmail($status));
        }

        if($request->ajax()) {
            return response()->json([
                'status' => true,
                'message' => 'Event payment method updated successfully'
            ]);
        } else {
            return redirect()->route('finance.index')->with('success', 'Event payment updated successfully.');
        }
    }



    /**
     * Display the specified event payment configuration.
     */
    public function show($id)
    {
        $eventPayment = EventPayment::with(['event', 'paymentMethod', 'company'])->findOrFail($id);
        return view('finance.payment', compact('eventPayment'));
    }



    /**
     * Remove the specified event payment configuration from storage.
     */
    public function destroy($id)
    {
        $eventPayment = EventPayment::findOrFail($id);
        $eventPayment->delete();

        return redirect()->route('finance.index')->with('success', 'Event payment configuration deleted successfully.');
    }
}
