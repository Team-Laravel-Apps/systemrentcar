<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Role;

class RoleUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'id_role'     => '0001',
            'nama_role'   => 'Superadmin',
        ];

        Role::insert($roles);
    }
}
