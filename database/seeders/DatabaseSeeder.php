<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Table User

        User::create([
            'nama' => 'Administrator',
            'email' => 'admin@gmail.com',
            'role' => '0',
            'hp' => '081234567890',
            'password' => bcrypt('p@55word'),
        ]);
        User::create([
            'nama' => 'Willy',
            'email' => 'kasir@gmail.com',
            'role' => '1',
            'hp' => '081234567890',
            'password' => bcrypt('p@55word'),
        ]);
        User::create([
            'nama' => 'Arnanda',
            'email' => 'barista@gmail.com',
            'role' => '2',
            'hp' => '081234567890',
            'password' => bcrypt('p@55word'),
        ]);
        Kategori::create([
            'nama_kategori' => 'Kopi'
        ]);
        Kategori::create([
            'nama_kategori' => 'Non-Kopi'
        ]);
    }
}
