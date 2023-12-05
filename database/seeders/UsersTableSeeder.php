<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superusers = [
            'id_users'    => 'S0001',
            'id_role'     => '0001',
            'nama'        => 'Superadmin',
            'username'    => 'superadmin',
            'email'       => 'admin@example.com',
            'password'    => Hash::make('superadmin'),
            'no_telpon'   => '087894484256',
            'alamat'      => 'Jl Mawar No. 40, Delod Peken, Tabanan, Bali - Indonesia',
            'ktp'         => null,
            'nik'         => null,
            'created_at'  => now(),
            'updated_at'  => now(),
        ];

        User::insert($superusers);
    }
}
