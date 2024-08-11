<!-- Modal -->
<div class="modal fade" id="addEventModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addEventLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addEventLabel">Add Event</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="add_event_form">
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    <label class="label" for="name">Name</label>
                    <input class="form-control" type="text" name="name" placeholder="Enter event name" required>
                </div>
                <div class="form-group mt-3">
                    <label class="label" for="date">Date</label>
                    <input class="form-control" type="date" name="date" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="form-group mt-3">
                    <label class="label" for="location">Location</label>
                    <select class="form-control" name="location">
                        <option>Malta</option>
                        <option>Brazil</option>
                        <option>Africa</option>
                        <option>Asia</option>
                        <option>East Europe</option>
                        <option>Eurasia</option>
                    </select>
                </div>
                
                <div class="form-group mt-3">
                    <label class="label" for="description">Description</label>
                    <textarea class="form-control" name="description"></textarea>
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
    $(document).on('submit', '#add_event_form', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        
        $.ajax({
            type: "POST",
            url: "{{ url('/finance/store-event') }}",
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
        });
    })
</script>

