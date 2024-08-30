<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('room')->get();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $rooms = Room::all();
        return view('bookings.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_email' => 'required|email',
            'customer_phone' => 'required',
            'room_id' => 'required|exists:rooms,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $room = Room::findOrFail($request->room_id);
        $total_cost = $this->calculateCost($room->id, $request->start_date, $request->end_date);

        Booking::create([
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'room_id' => $room->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_cost' => $total_cost,
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking made successfully.');
    }

    private function calculateCost($roomId, $startDate, $endDate)
    {
        $startDateObj = new \DateTime($startDate);
        $endDateObj = new \DateTime($endDate);
        $days = $endDateObj->diff($startDateObj)->days + 1;

        $room = Room::findOrFail($roomId);
        $roomType = $room->room_type;

        $prices = [
            'Deluxe' => 10,
            'Luxury' => 20,
            'Royal' => 30,
        ];

        $rate = $prices[$roomType] ?? 10;
        $totalCost = $days * $rate;

        return $totalCost;
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->start_date = Carbon::parse($booking->start_date);
        $booking->end_date = Carbon::parse($booking->end_date);
        return view('bookings.edit', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'total_cost' => 'required|numeric|min:0',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->customer_name = $request->input('customer_name');
        $booking->customer_email = $request->input('customer_email');
        $booking->start_date = Carbon::parse($request->input('start_date'));
        $booking->end_date = Carbon::parse($request->input('end_date'));
        $booking->total_cost = $request->input('total_cost');
        $booking->save();

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully');
    }
}
