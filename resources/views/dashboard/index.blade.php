@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="table-info custom-header">Dashboard</h1>

    <!-- Calendar Heatmap -->
    <div id="calendar"></div>

    <!-- Occupancy Details -->
    <div id="occupancyDetails">
        <!-- Details will be loaded here based on selected date -->
    </div>

    <!-- Rooms Getting Vacant Today -->
    <h2>Rooms Getting Vacant Today</h2>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class="table-info">Room No</th>
                <th class="table-info">Customer Name</th>
                <th class="table-info">End Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vacatingRooms as $booking)
            <tr>
                <td class="table-light">{{ $booking->room->room_no }}</td>
                <td class="table-light">{{ $booking->customer_name }}</td>
                <td class="table-light">{{ $booking->end_date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- New Guests Arriving Today -->
    <h2>New Guests Arriving Today</h2>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class="table-info">Room No</th>
                <th class="table-info">Customer Name</th>
                <th class="table-info">Start Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($newGuests as $booking)
            <tr>
                <td class="table-light">{{ $booking->room->room_no }}</td>
                <td class="table-light">{{ $booking->customer_name }}</td>
                <td class="table-light">{{ $booking->start_date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Initialize DataTables -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js'></script>

<script>
$(document).ready(function() {
    $('#bookingsTable').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true
    });

    // Custom styles for table
    $('head').append(`
        <style>
            /* Custom styling for table headers */
            table.dataTable thead th {
                background-color: #343a40;
                color: #ffffff;
            }
            /* Custom styling for table rows */
            table.dataTable tbody tr:nth-child(odd) {
                background-color: #f8f9fa;
            }
            table.dataTable tbody tr:nth-child(even) {
                background-color: #ffffff;
            }
            /* Custom styling for search input */
            .dataTables_wrapper .dataTables_filter input {
                border: 1px solid #ced4da;
                border-radius: 4px;
                padding: 0.5em;
                color: #495057;
            }
            /* Custom styling for pagination buttons */
            .dataTables_wrapper .dataTables_paginate .paginate_button {
                padding: 0.5em 1em;
                border: 1px solid #dee2e6;
                border-radius: 4px;
                background-color: #f8f9fa;
                color: #495057;
                margin: 0 2px;
            }
            .dataTables_wrapper .dataTables_paginate .paginate_button.current {
                background-color: #007bff;
                color: #ffffff;
                border: 1px solid #007bff;
            }
            .custom-header {
                color: #ffffff;
            }
        </style>
    `);

    // Initialize calendar and heatmap
    $('#calendar').fullCalendar({
        events: @json($occupancy),
        // Add more options and customization as needed
    });

    // Event click to show occupancy details
    $('#calendar').fullCalendar('option', 'dayClick', function(date) {
        $.ajax({
            url: '{{ route("dashboard.getOccupancyDetails") }}',
            method: 'GET',
            data: { date: date.format() },
            success: function(data) {
                var detailsHtml = '<h3>Occupancy Details for ' + date.format('YYYY-MM-DD') + '</h3>';
                detailsHtml += '<table class="table table-striped table-bordered"><thead><tr><th class="table-info">Room No</th><th class="table-info">Customer Name</th><th class="table-info">Start Date</th><th class="table-info">End Date</th></tr></thead><tbody>';
                
                data.forEach(function(booking) {
                    detailsHtml += '<tr><td class="table-light">' + booking.room.room_no + '</td><td class="table-light">' + booking.customer_name + '</td><td class="table-light">' + booking.start_date + '</td><td class="table-light">' + booking.end_date + '</td></tr>';
                });
                
                detailsHtml += '</tbody></table>';
                $('#occupancyDetails').html(detailsHtml);
            }
        });
    });
});
</script>

@endsection
