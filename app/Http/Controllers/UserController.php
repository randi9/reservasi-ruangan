<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function history()
    {
        $user = auth()->user();

        $myReservations = $user->reservations()
                               ->with('room') 
                               ->orderBy('start_time', 'desc')
                               ->get();

        return view('users.history', compact('myReservations'));
    }
}