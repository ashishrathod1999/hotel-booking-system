@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="table-info custom-header">Bookings</h1>
    <table id="bookingsTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Room No</th>
                <th>Customer Name</th>
                <th>Customer Email</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Total Cost</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->room->room_no }}</td>
                <td>{{ $booking->customer_name }}</td>
                <td>{{ $booking->customer_email }}</td>
                <td>{{ $booking->start_date }}</td>
                <td>{{ $booking->end_date }}</td>
                <td>{{ $booking->total_cost }}</td>
                <td>
                    <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
