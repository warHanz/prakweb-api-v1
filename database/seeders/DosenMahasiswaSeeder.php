<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DosenMahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        $now = Carbon::now();

        // Seeder untuk Dosen
        foreach (range(1, 10) as $index) {
            DB::table('dosens')->insert([
                'NIP' => $faker->unique()->numerify('##########'), // NIP terdiri dari 10 digit
                'nama' => $faker->name,
                'alamat' => $faker->address,
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'no_telepon' => $faker->phoneNumber,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // Seeder untuk Mahasiswa
        foreach (range(1, 10) as $index) {
            DB::table('mahasiswas')->insert([
                'NIM' => $faker->unique()->numerify('##########'), // NIM terdiri dari 10 digit
                'nama' => $faker->name,
                'alamat' => $faker->address,
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'no_telepon' => $faker->phoneNumber,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
