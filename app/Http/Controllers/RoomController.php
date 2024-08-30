<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomRent;

class RoomController extends Controller
{
    // Display a listing of rooms
    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    // Show the form for creating a new room
    public function create()
    {
        return view('rooms.create');
    }

    // Store a newly created room in storage
    public function store(Request $request)
    {
        $room = Room::create($request->all());
        return redirect()->route('rooms.index');
    }

    // Display the specified room
    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }


public function edit($id)
{
    $room = Room::findOrFail($id);
    return view('rooms.edit', compact('room'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'room_no' => 'required|string|max:255',
        'room_type' => 'required|string|max:255',
        'bathtub' => 'required|boolean',
        'balcony' => 'required|boolean',
        'mini_bar' => 'required|boolean',
        'max_occupancy' => 'required|integer|min:1',
    ]);

    $room = Room::findOrFail($id);
    $room->update($request->all());

    return redirect()->route('rooms.index')->with('success', 'Room updated successfully.');
}

public function destroy($id)
{
    $room = Room::findOrFail($id);
    $room->delete();

    return redirect()->route('rooms.index')->with('success', 'Room deleted successfully.');
}
}
