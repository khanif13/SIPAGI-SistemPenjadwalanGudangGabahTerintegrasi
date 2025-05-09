<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('admin123'),
                'role_id' => '1',
            ],
            [
                'name' => 'Manager Gudang 1',
                'username' => 'manager1',
                'email' => 'manager1@example.com',
                'password' => bcrypt('manager123'),
                'role_id' => '2',
            ],
            [
                'name' => 'Petani 1',
                'username' => 'petani1',
                'email' => 'petani1@example.com',
                'password' => bcrypt('petani123'),
                'role_id' => '3',
            ],
        ]);
    }
}
