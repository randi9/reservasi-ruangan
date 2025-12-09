@extends('layout')

@section('content')
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Riwayat Reservasi Saya</h2>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr class="bg-gray-800 text-white uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Ruangan</th>
                    <th class="py-3 px-6 text-left">Keperluan</th>
                    <th class="py-3 px-6 text-left">Waktu</th>
                    <th class="py-3 px-6 text-center">Status</th>
                    <th class="py-3 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @forelse($myReservations as $res)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="py-3 px-6 text-left font-bold">{{ $res->room->name }}</td>
                    <td class="py-3 px-6 text-left">{{ $res->title }}</td>
                    <td class="py-3 px-6 text-left">
                        {{ $res->start_time->format('d M Y') }}<br>
                        <span class="text-xs font-bold text-gray-500">
                            {{ $res->start_time->format('H:i') }} - {{ $res->end_time->format('H:i') }}
                        </span>
                    </td>
                    <td class="py-3 px-6 text-center">
                        @if($res->end_time < now())
                            <span class="bg-gray-200 text-gray-600 py-1 px-3 rounded-full text-xs">Selesai</span>
                        @else
                            <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">Aktif</span>
                        @endif
                    </td>
                    <td class="py-3 px-6 text-center">
                        @if($res->end_time > now()) 
                            <form action="{{ route('reservations.destroy', $res->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded text-xs transition">
                                    Batalkan
                                </button>
                            </form>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-6 px-6 text-center text-gray-400">Kamu belum pernah melakukan reservasi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection