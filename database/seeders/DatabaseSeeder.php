<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin Kantor',
            'email' => 'admin@kantor.com',
            'password' => bcrypt('password123')
        ]);

        User::create([
            'name' => 'Pahlawan',
            'email' => 'pahlawan@kantor.com',
            'password' => bcrypt('pahlawan123')
        ]);

        User::create([
            'name' => 'Manajer',
            'email' => 'Majer@kantor.com',
            'password' => bcrypt('manajer123')
        ]);

        Room::create([
            'name' => 'Ruang Meeting A',
            'capacity' => 10,
            'description' => 'Lantai 1, Dilengkapi Proyektor & Whiteboard'
        ]);

        Room::create([
            'name' => 'Ruang VIP',
            'capacity' => 5,
            'description' => 'Lantai 2, Sofa Empuk & TV Besar'
        ]);

        Room::create([
            'name' => 'Aula Serbaguna',
            'capacity' => 50,
            'description' => 'Lantai Dasar, Sound System Lengkap'
        ]);
    }
}
