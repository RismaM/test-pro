<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\tb_m_user;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //masukan data user admin ke database tb_m_user
        tb_m_user::create([
            'name' => 'Administrator',
            'username' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => 'admin',
            'status' => 'active',
            'role' => 'admin',
            'created_by_tmu' => '1',
        ]);

        //panggil UserFactory, generate sebanyak 50 data
        tb_m_user::factory()->count(50)->make();
    }
}
