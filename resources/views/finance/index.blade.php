<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Finance Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="row justify-content-between">
                        <div class="col-auto">Events</div>
                        <div class="col-auto">
                            <button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#addEventModal">Add Event</button>
                        </div>
                    </div>
                    <table class="table mt-5">
                        <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Location</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($events as $event)
                            <tr>
                                <td> {{ $event->name }} </td>
                                <td> {{ $event->location }} </td>
                                <td> {{ date('m-d-Y', strtotime($event->date)) }} </td>
                                <td> {{ $event->description }} </td>
                                <td> 
                                    <a href="javascript:void(null)" class="btn btn-sm btn-secondary event_data" data-id="{{ $event->id }}" data-name="{{ $event->name }}" data-bs-toggle="modal" data-bs-target="#addPaymentModal">Add Payment Method</a>
                                    <a href="javascript:void(null)" class="btn btn-sm btn-danger event_data" data-id="{{ $event->id }}" data-name="{{ $event->name }}" data-bs-toggle="modal" data-bs-target="#requestPaymentProviderModal">Request New Payment Provider</a>
                                </td>
                            </tr>
                            @empty
                            <tr>    
                                <td colspan="5" class="text-center">No data found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="row justify-content-between">
                        <div class="col-auto">Event Payments</div>
                    </div>
                    <table class="table mt-5">
                        <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Location</th>
                                <th>Date</th>
                                <th>Company</th>
                                <th>Vat Rate</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($eventPayments as $payment)
                            <tr>
                                <td> {{ $payment->event->name }} </td>
                                <td> {{ $payment->event->location }} </td>
                                <td> {{ date('m-d-Y', strtotime($payment->event->date)) }} </td>
                                <td> {{ $payment->company->name }}</td>
                                <td> ${{ $payment->vat_rate }}</td>
                                <td> 
                                    <a href="javascript:void(null)" class="btn btn-sm btn-warning update_event_data" data-url="{{ route('event-payments.update', $payment->id ) }}" data-name="{{$payment->event->name}}" data-payment="{{json_encode($payment)}}" data-bs-toggle="modal" data-bs-target="#editPaymentModal">Update Payment Method</a>
                                    
                                </td>
                            </tr>
                            @empty
                            <tr>    
                                <td colspan="5" class="text-center">No data found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="row justify-content-between">
                        <div class="col-auto">New Payment Provider Requests</div>
                    </div>
                    <table class="table mt-5">
                        <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Location</th>
                                <th>Date</th>
                                <th>Company</th>
                                <th>Payment Method</th>
                                <th>website</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($provider_requests as $request)
                            <tr>
                                <td> {{ $request->event->name }} </td>
                                <td> {{ $request->event->location }} </td>
                                <td> {{ date('m-d-Y', strtotime($request->event->date)) }} </td>
                                <td> {{ $request->company->name }}</td>
                                <td> {{ $request->payment_method_name }}</td>
                                <td> {{ $request->website }}</td>
                                <td> {{ $request->status }}</td>
                            </tr>
                            @empty
                            <tr>    
                                <td colspan="5" class="text-center">No data found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@include('finance.modals.add_event_modal')
@include('finance.modals.add_payment_method_modal')
@include('finance.modals.edit_payment_method_modal')
@include('finance.modals.request_payment_provider_modal')

<script>
    $(document).on('click', '.event_data', function() {
        $('#event_id').val($(this).data('id'))
        $('#event_id_1').val($(this).data('id'))
        $('#event_name').val($(this).data('name'))
        $('#event_name_1').val($(this).data('name'))
    })

    $(document).on('click', '.update_event_data', function() {
        var event_payment_data = $(this).data('payment')
        $('#event_name_2').val($(this).data('name'))
        $('#edit_payment_form').attr('action', $(this).data('url'))
        $('#payment_method_id').val(event_payment_data.payment_method_id)
        $('#company_id').val(event_payment_data.company_id)
        $('#vat_rate').val(event_payment_data.vat_rate)
    })
</script>
