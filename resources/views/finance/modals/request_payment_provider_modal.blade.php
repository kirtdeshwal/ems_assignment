<!-- Modal -->
<div class="modal fade" id="requestPaymentProviderModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="requestPaymentProviderLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="requestPaymentProviderLabel">Request New Payment Provider</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="request_payment_provider_form">
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    <label class="label" for="payment_method_name">Payment Method Name</label>
                    <input class="form-control" name="payment_method_name" type="text" placeholder="Enter payment method name">
                </div>
                <div class="form-group mt-3">
                    <label class="label" for="website">Website</label>
                    <input class="form-control" name="website" type="text" placeholder="Enter website">
                </div>
                <div class="form-group mt-3">
                    <label class="label" for="name">Event Name</label>
                    <input class="form-control" disabled type="text" id="event_name_1" placeholder="Enter event name">
                    <input type="hidden" id="event_id_1" name="event_id">
                </div>
                <div class="form-group mt-3">
                    <label class="label" for="location">Company</label>
                    <select class="form-control" name="company_id">
                        @foreach($companies as $company)
                        <option value="{{ $company->id }}"> {{ $company->name }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).on('submit', '#request_payment_provider_form', function(e) {
        e.preventDefault()
        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "{{ url('/payment-provider-request') }}",
            data: formData, 
            processData: false, 
            contentType: false,
            success: function(response) {
                if(response.status == true) {
                    location.reload()
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        })
    })
</script>