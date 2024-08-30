@extends('layouts.app')

@section('content')
<div class="container">
<h1 class="table-info custom-header">Room Details</h1>

    
    <a href="{{ route('rooms.create') }}" class="btn btn-primary mb-3">Add Room</a>
    <table id="roomsTable"  class="table table-striped table-bordered" >
    <thead  class="table-dark">
    <tr>
        <th class="table-info">Room No</th>
        <th class="table-info">Type</th>
        <th class="table-info">Bathtub</th>
        <th class="table-info">Balcony</th>
        <th class="table-info">Mini Bar</th>
        <th class="table-info">Max Occupancy</th>
        <th class="table-info">Actions</th>
    </tr>
</thead>
<tbody>
    @foreach($rooms as $room)
    <tr>
        <td class="table-light">{{ $room->room_no }}</td>
        <td class="table-light">{{ $room->room_type }}</td>
        <td class="table-light">{{ $room->bathtub ? 'Yes' : 'No' }}</td>
        <td class="table-light">{{ $room->balcony ? 'Yes' : 'No' }}</td>
        <td class="table-light">{{ $room->mini_bar ? 'Yes' : 'No' }}</td>
        <td class="table-light">{{ $room->max_occupancy }}</td>
         
        <td  class="table-light">
            <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-info btn-sm">View</a>
            <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this room?');">
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
<script>
$(document).ready(function() {
    $('#roomsTable').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true
    });
});
</script>
<style>
     .custom-header {
        color: #ffffff;   /* Darker blue text color */
    } 
    
/* Custom styling for table headers */
table.dataTable thead th {
    background-color: #343a40; /* Dark background for header */
    color: #ffffff; /* White text color */
}

/* Custom styling for table rows */
table.dataTable tbody tr:nth-child(odd) {
    background-color: #f8f9fa; /* Light gray for odd rows */
}

table.dataTable tbody tr:nth-child(even) {
    background-color: #ffffff; /* White for even rows */
}

/* Custom styling for search input */
.dataTables_wrapper .dataTables_filter input {
    border: 1px solid #ced4da; /* Border color */
    border-radius: 4px; /* Rounded corners */
    padding: 0.5em; /* Padding inside the search box */
    color: #495057; /* Text color */
}

/* Custom styling for pagination buttons */
.dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: 0.5em 1em; /* Padding for buttons */
    border: 1px solid #dee2e6; /* Border color */
    border-radius: 4px; /* Rounded corners */
    background-color: #f8f9fa; /* Light background for buttons */
    color: #495057; /* Text color */
    margin: 0 2px; /* Spacing between buttons */
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background-color: #007bff; /* Blue background for the current page button */
    color: #ffffff; /* White text color for the current page button */
    border: 1px solid #007bff; /* Border color matching the background */
}
</style>

@endsection
