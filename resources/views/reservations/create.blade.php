@extends('layout')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Buat Reservasi Baru</h2>

    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Ruangan</label>
            <select name="room_id" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                <option value="">-- Pilih Ruangan --</option>
                @foreach($rooms as $r)
                    <option value="{{ $r->id }}" {{ request('room_id') == $r->id ? 'selected' : '' }}>
                        {{ $r->name }} (Kapasitas: {{ $r->capacity }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Judul / Keperluan</label>
            <input type="text" name="title" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" placeholder="Contoh: Daily Scrum Team A">
        </div>

        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Waktu Mulai</label>
                <input type="datetime-local" name="start_time" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                <p class="text-xs text-gray-500 mt-1">Jam Kerja: 08:00 - 17:00</p>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Waktu Selesai</label>
                <input type="datetime-local" name="end_time" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
            </div>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition">
            Simpan Reservasi
        </button>
    </form>
</div>
@endsection