<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat User Panitia terlebih dahulu
        $panitia = User::create([
            'name' => 'Panitia Kampus',
            'email' => 'panitia@kampus.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'panitia',
        ]);

        // 2. Inisialisasi Faker Indonesia untuk data event
        $faker = \Faker\Factory::create('id_ID');

        // 3. Buat data Event yang otomatis memakai ID Panitia di atas
        for ($i = 0; $i < 5; $i++) {
            DB::table('events')->insert([
                'user_id' => $panitia->id, // Menggunakan ID dari user yang baru dibuat
                'nama' => 'Seminar ' . $faker->words(3, true),
                'deskripsi' => $faker->text(200),
                'tanggal' => Carbon::now()->addDays(rand(5, 30))->toDateTimeString(),
                'lokasi' => 'Aula Gedung ' . rand(1, 5) . ', Kampus Utama',
                'kuota' => rand(50, 200),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
