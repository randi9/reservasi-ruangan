<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory, SoftDeletes; 

    protected $fillable = [
        'user_id',
        'room_id',
        'title',
        'start_time',
        'end_time',
    ];

    // Mengubah string datetime dari database menjadi object Carbon
    // Supaya nanti bisa pakai format(), addHours(), dll di view/controller
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    // ==========================
    // RELATIONS
    // ==========================

    // Reservasi milik satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Reservasi untuk satu Room
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    // ==========================
    // SCOPES (Logic Query)
    // ==========================

    /**
     * Scope untuk mengecek apakah ada jadwal yang bentrok.
     * Cara pakai di Controller: 
     * Reservation::checkOverlap($room_id, $start, $end)->exists();
     */
    public function scopeCheckOverlap($query, $roomId, $startTime, $endTime)
    {
        return $query->where('room_id', $roomId)
                     ->where(function ($q) use ($startTime, $endTime) {
                         // Logika Matematika Overlap:
                         // (Start Baru < End Lama) AND (End Baru > Start Lama)
                         $q->where('start_time', '<', $endTime)
                           ->where('end_time', '>', $startTime);
                     });
    }
}