@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Room Details</h1>

    <!-- Room Image -->
    @if($room->image)
    <div class="text-center mb-4">
        <img src="{{ asset('storage/rooms/' . $room->image) }}" alt="Room Image" class="img-fluid" style="max-width: 100%; height: auto;">
    </div>
    @endif

    <!-- Room Details Table -->
    <div class="card">
        <div class="card-header">
            Room Information
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Room No</th>
                        <td>{{ $room->room_no }}</td>
                    </tr>
                    <tr>
                        <th>Room Type</th>
                        <td>{{ $room->room_type }}</td>
                    </tr>
                    <tr>
                        <th>Bathtub</th>
                        <td>{{ $room->bathtub ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <th>Balcony</th>
                        <td>{{ $room->balcony ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <th>Mini Bar</th>
                        <td>{{ $room->mini_bar ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <th>Max Occupancy</th>
                        <td>{{ $room->max_occupancy }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Back Button -->
    <div class="mt-4">
        <a href="{{ route('rooms.index') }}" class="btn btn-primary">Back to Room List</a>
    </div>
</div>
@endsection
