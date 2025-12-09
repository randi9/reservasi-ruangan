@extends('layout')

@section('content')
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Daftar Ruang Rapat</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($rooms as $room)
        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
            <h3 class="text-xl font-bold text-blue-600 mb-2">{{ $room->name }}</h3>
            <p class="text-gray-600 mb-4">{{ $room->description }}</p>
            
            <div class="flex justify-between items-center text-sm text-gray-500 mb-4">
                <span>👥 Kapasitas: {{ $room->capacity }} orang</span>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('rooms.show', $room->id) }}" class="flex-1 bg-gray-200 text-center py-2 rounded text-gray-700 hover:bg-gray-300">
                    Lihat Jadwal
                </a>
                <a href="{{ route('reservations.create', ['room_id' => $room->id]) }}" class="flex-1 bg-blue-600 text-center py-2 rounded text-white hover:bg-blue-700">
                    Booking
                </a>
            </div>
        </div>
        @endforeach
    </div>
@endsection