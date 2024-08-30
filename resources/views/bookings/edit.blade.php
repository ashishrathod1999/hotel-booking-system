@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="table-info custom-header">Edit Booking</h1>
    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="customer_name">Customer Name:</label>
            <input type="text" class="form-control" name="customer_name" id="customer_name" value="{{ $booking->customer_name }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="customer_email">Customer Email:</label>
            <input type="email" class="form-control" name="customer_email" id="customer_email" value="{{ $booking->customer_email }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="start_date">Start Date:</label>
            <input type="date" class="form-control" name="start_date" id="start_date" value="{{ $booking->start_date->format('Y-m-d') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="end_date">End Date:</label>
            <input type="date" class="form-control" name="end_date" id="end_date" value="{{ $booking->end_date->format('Y-m-d') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="total_cost">Total Cost:</label>
            <input type="number" class="form-control" name="total_cost" id="total_cost" value="{{ $booking->total_cost }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Booking</button>
    </form>
</div>
@endsection
