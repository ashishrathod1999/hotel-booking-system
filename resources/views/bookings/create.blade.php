@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="table-info custom-header">Add New Booking</h1>
    <form id="bookingForm">
        @csrf
        <div class="form-group mb-3">
            <label for="customer_name">Customer Name:</label>
            <input type="text" class="form-control" name="customer_name" id="customer_name" required>
        </div>

        <div class="form-group mb-3">
            <label for="customer_email">Customer Email:</label>
            <input type="email" class="form-control" name="customer_email" id="customer_email" required>
        </div>

        <div class="form-group mb-3">
            <label for="customer_phone">Customer Phone:</label>
            <input type="text" class="form-control" name="customer_phone" id="customer_phone" required>
        </div>

        <div class="form-group mb-3">
            <label for="room_id">Room:</label>
            <select class="form-select" name="room_id" id="room_id" required>
                <option value="" disabled selected>Select Room</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->room_no }} - {{ $room->room_type }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="start_date">Start Date:</label>
            <input type="date" class="form-control" name="start_date" id="start_date" required>
        </div>

        <div class="form-group mb-3">
            <label for="end_date">End Date:</label>
            <input type="date" class="form-control" name="end_date" id="end_date" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Booking</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#bookingForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            type: 'POST',
            url: "{{ route('bookings.store') }}",
            data: $(this).serialize(),
            success: function(response) {
                window.location.href = "{{ route('bookings.index') }}";
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseText);
            }
        });
    });
});
</script>
<style>
.custom-header {
    color: #ffffff;   /* Darker blue text color */
}
</style>
@endsection
