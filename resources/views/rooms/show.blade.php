@extends('layout')

@section('content')
    <div class="mb-6">
        <a href="{{ route('rooms.index') }}" class="text-blue-500 hover:underline">&larr; Kembali</a>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h1 class="text-3xl font-bold text-gray-800">{{ $room->name }}</h1>
        <p class="text-gray-600 mt-2">{{ $room->description }}</p>
        <p class="text-gray-500 mt-1">Kapasitas: {{ $room->capacity }} Orang</p>
        
        <div class="mt-6">
            <a href="{{ route('reservations.create', ['room_id' => $room->id]) }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Buat Reservasi di Ruangan Ini
            </a>
        </div>
    </div>

    <h3 class="text-xl font-bold mb-4 text-gray-800">📅 Jadwal Terisi (Upcoming)</h3>
    
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Agenda</th>
                    <th class="py-3 px-6 text-left">Pemesan</th>
                    <th class="py-3 px-6 text-left">Waktu Mulai</th>
                    <th class="py-3 px-6 text-left">Waktu Selesai</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @forelse($upcomingReservations as $res)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="py-3 px-6 text-left whitespace-nowrap font-medium">{{ $res->title }}</td>
                    <td class="py-3 px-6 text-left">{{ $res->user->name }}</td>
                    <td class="py-3 px-6 text-left">{{ $res->start_time->format('d M Y - H:i') }}</td>
                    <td class="py-3 px-6 text-left">{{ $res->end_time->format('d M Y - H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-6 px-6 text-center text-gray-400">Belum ada jadwal reservasi mendatang.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection