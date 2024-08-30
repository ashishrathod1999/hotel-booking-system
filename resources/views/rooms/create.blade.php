@extends('layouts.app')

@section('content')
<div class="container">
    <h1 >Add Room</h1>
    <form id="addRoomForm" action="{{ route('rooms.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="room_no">Room No</label>
            <input type="text" class="form-control" id="room_no" name="room_no" required>
        </div>
        <div class="form-group">
            <label for="room_type">Room Type</label>
            <select class="form-control" id="room_type" name="room_type" required>
                <option value="Deluxe">Deluxe</option>
                <option value="Luxury">Luxury</option>
                <option value="Royal">Royal</option>
            </select>
        </div>
        <div class="form-group">
            <label for="bathtub">Bathtub</label>
            <select class="form-control" id="bathtub" name="bathtub">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="balcony">Balcony</label>
            <select class="form-control" id="balcony" name="balcony">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="mini_bar">Mini Bar</label>
            <select class="form-control" id="mini_bar" name="mini_bar">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="max_occupancy">Max Occupancy</label>
            <input type="number" class="form-control" id="max_occupancy" name="max_occupancy" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Room</button>
    </form>
</div>

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#addRoomForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            var form = $(this);
            var url = form.attr('action');
            var formData = form.serialize();

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Handle the response from the server
                   
                    window.location.href = 'http://127.0.0.1:8000/rooms';
                },
                error: function(xhr) {
                    // Handle errors here
                    alert('An error occurred while adding the room.');
                }
            });
        });
    });
</script>
@endsection
@endsection
