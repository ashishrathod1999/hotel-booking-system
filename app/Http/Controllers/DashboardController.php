<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch all bookings
        $bookings = Booking::with('room')->get();

        // Calculate occupancy percentages for each date
        $occupancy = [];
        $roomCount = Room::count();
        
        foreach ($bookings as $booking) {
            $period = new \DatePeriod(
                new \DateTime($booking->start_date),
                new \DateInterval('P1D'),
                (new \DateTime($booking->end_date))->modify('+1 day')
            );

            foreach ($period as $date) {
                $dateString = $date->format('Y-m-d');
                if (!isset($occupancy[$dateString])) {
                    $occupancy[$dateString] = 0;
                }
                $occupancy[$dateString]++;
            }
        }

        foreach ($occupancy as $date => $count) {
            $occupancy[$date] = ($count / $roomCount) * 100;
        }

        // Fetch rooms getting vacant today and new guests arriving today
        $today = date('Y-m-d');
        $vacatingRooms = Booking::where('end_date', $today)->with('room')->get();
        $newGuests = Booking::where('start_date', $today)->with('room')->get();

        return view('dashboard.index', compact('bookings', 'occupancy', 'vacatingRooms', 'newGuests'));
    }

    public function getOccupancyDetails(Request $request)
    {
        $date = $request->input('date');
        $bookings = Booking::whereDate('start_date', '<=', $date)
                           ->whereDate('end_date', '>=', $date)
                           ->with('room')
                           ->get();
        
        return response()->json($bookings);
    }
}
