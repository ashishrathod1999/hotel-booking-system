@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Room</h1>
    <form action="{{ route('rooms.update', $room->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="room_no">Room No</label>
            <input type="text" class="form-control" id="room_no" name="room_no" value="{{ $room->room_no }}" required>
        </div>
        <div class="form-group">
            <label for="room_type">Room Type</label>
            <select class="form-control" id="room_type" name="room_type" required>
                <option value="Deluxe" {{ $room->room_type == 'Deluxe' ? 'selected' : '' }}>Deluxe</option>
                <option value="Luxury" {{ $room->room_type == 'Luxury' ? 'selected' : '' }}>Luxury</option>
                <option value="Royal" {{ $room->room_type == 'Royal' ? 'selected' : '' }}>Royal</option>
            </select>
        </div>
        <div class="form-group">
            <label for="bathtub">Bathtub</label>
            <select class="form-control" id="bathtub" name="bathtub" required>
                <option value="1" {{ $room->bathtub ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$room->bathtub ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="balcony">Balcony</label>
            <select class="form-control" id="balcony" name="balcony" required>
                <option value="1" {{ $room->balcony ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$room->balcony ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="mini_bar">Mini Bar</label>
            <select class="form-control" id="mini_bar" name="mini_bar" required>
                <option value="1" {{ $room->mini_bar ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$room->mini_bar ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="max_occupancy">Max Occupancy</label>
            <input type="number" class="form-control" id="max_occupancy" name="max_occupancy" value="{{ $room->max_occupancy }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Room</button>
    </form>
</div>
@endsection
