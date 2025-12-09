<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    public function show(Room $room)
    {
        $upcomingReservations = $room->reservations()
                                     ->where('start_time', '>=', now())
                                     ->orderBy('start_time', 'asc')
                                     ->get();

        return view('rooms.show', compact('room', 'upcomingReservations'));
    }
}