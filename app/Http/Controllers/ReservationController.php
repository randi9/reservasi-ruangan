<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class ReservationController extends Controller
{
    public function create()
    {
        $rooms = Room::all();
        return view('reservations.create', compact('rooms'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'room_id'    => 'required|exists:rooms,id',
            'title'      => 'required|string|max:255',
            'start_time' => 'required|date|after:now', 
            'end_time'   => 'required|date|after:start_time',
        ]);

        $start = Carbon::parse($request->start_time);
        $end   = Carbon::parse($request->end_time);

        if ($start->format('H:i') < '08:00' || $end->format('H:i') > '17:00') {
            throw ValidationException::withMessages([
                'start_time' => 'Reservasi hanya bisa dilakukan pada jam kerja (08:00 - 17:00).',
            ]);
        }

        if (!$start->isSameDay($end)) {
             throw ValidationException::withMessages([
                'end_time' => 'Reservasi harus selesai pada hari yang sama.',
            ]);
        }


        if (Reservation::checkOverlap($request->room_id, $start, $end)->exists()) {
            throw ValidationException::withMessages([
                'room_id' => 'Ruangan sudah dipesan pada jam tersebut. Silakan pilih waktu lain.',
            ]);
        }

        Reservation::create([
            'user_id'    => auth()->id(), 
            'room_id'    => $request->room_id,
            'title'      => $request->title,
            'start_time' => $start,
            'end_time'   => $end,
        ]);

        return redirect()->route('reservations.index')->with('success', 'Ruangan berhasil direservasi!');
    }

    public function destroy(Reservation $reservation)
    {
        if ($reservation->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki izin untuk membatalkan reservasi ini.');
        }

        $reservation->delete();

        return back()->with('success', 'Reservasi berhasil dibatalkan.');
    }
}