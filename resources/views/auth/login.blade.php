@extends('layout')

@section('content')
<div class="flex justify-center items-center h-[50vh]">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Login Karyawan</h2>

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" 
                       class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300" required autofocus>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Password</label>
                <input type="password" name="password" 
                       class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded hover:bg-blue-700 transition">
                Masuk
            </button>
        </form>
    </div>
</div>
@endsection