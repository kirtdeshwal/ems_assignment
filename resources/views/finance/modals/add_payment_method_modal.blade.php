<!-- Modal -->
<div class="modal fade" id="addPaymentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addPaymentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addPaymentLabel">Add Payment Method</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="add_payment_form">
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    <label class="label" for="name">Event Name</label>
                    <input class="form-control" disabled type="text" id="event_name" placeholder="Enter event name">
                    <input type="hidden" id="event_id" name="event_id">
                </div>
                <div class="form-group mt-3">
                    <label class="label" for="location">Payment Method</label>
                    <select class="form-control" name="payment_method_id">
                        @foreach($payment_methods as $method)
                        <option value="{{ $method->id }}"> {{ $method->name }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label class="label" for="location">Company</label>
                    <select class="form-control" name="company_id">
                        @foreach($companies as $company)
                        <option value="{{ $company->id }}"> {{ $company->name }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label class="label" for="vat_rate">Vat Rate</label>
                    <input class="form-control" type="number" step="any" name="vat_rate" required>
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
    $(document).on('submit', '#add_payment_form', function(e) {
        e.preventDefault()
        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "{{ url('/event-payments') }}",
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
