<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Store a newly created event in storage.
     */
    public function store_event(Request $request) {
        $request->validate([
            'name' => 'required|string|max:200',
            'location' => 'required|in:Malta,Brazil,Africa,Aisa,East Europe,Eurasia',
            'date' => 'required'
        ]);

        try {
            $event = Event::create($request->all());
            if($event) {
                return response()->json([
                    'status' => true,
                    'message' => 'Event created successfully'
                ], 201);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Something went wrong'
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong '.$e->getMessage()
            ], 500);
        }
    }
}
