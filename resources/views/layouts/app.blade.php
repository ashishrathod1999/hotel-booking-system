<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking System</title>
    <link rel="icon" href="{{ asset('storage/images/images.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        html, body {
            height: 100%; /* Ensure full height */
            margin: 0; /* Remove default margin */
        }
        body {
            background-image: url('{{ asset('storage/images/1693209409898.jpg') }}'); /* Full-page background image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            flex-direction: column;
            color: white; /* Default text color to white */
        }
        .navbar {
            background: rgba(0, 0, 0, 0.5); /* Semi-transparent black background for navbar */
            padding: 0.5rem 1rem;
        }
        .navbar-brand img {
            height: 100px;
            width: auto;
        }
        .nav-link {
            color: #ffffff; /* White text color */
            transition: background-color 0.3s, color 0.3s; /* Smooth transition */
        }
        .nav-link:hover {
            background-color: #007bff; /* Blue background on hover */
            color: #ffffff; /* White text color on hover */
            border-radius: 4px; /* Rounded corners */
            padding: 0.5rem 1rem; /* Adjust padding on hover */
        }
        .nav-link i {
            margin-right: 10px; /* Space between icon and text */
        }
        .container {
            flex: 1; /* Ensure container takes up remaining space */
            background: rgba(0, 0, 0, 0.7); /* Semi-transparent black background for content */
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img src="{{ asset('storage/images/images.png') }}" alt="Hotel Logo">
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('rooms.index') }}">
                        <i class="fas fa-bed"></i> Rooms
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bookings.create') }}">
                        <i class="fas fa-calendar-check"></i> Book Room
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        @yield('content')
    </div>

    @yield('scripts')
</body>
</html>
