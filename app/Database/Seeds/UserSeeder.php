<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {

        $data = ['Admin', 'Cashier', 'Member'];

        foreach ($data as $role) {
            $this->db->table('roles')->insert([
                'name' => $role
            ]);
        }

        $data = [
            [
                'fullname' => 'admin',
                'role' => 1,
                'email' => 'admin@admin.com',
                'password' => password_hash('admin', PASSWORD_DEFAULT),
            ]
        ];

        foreach($data as $user){
            $this->db->table('users')->insert([
                'fullname' => $user['fullname'],
                'email' => $user['email'],
                'role' => $user['role'],
                'password' => $user['password'],
            ]);
        }
    }
}
