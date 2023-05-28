<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TypesSeeder extends Seeder
{
    public function run()
    {
        $data = ['Makanan', 'Minuman'];

        foreach($data as $type){
            $this->db->table('types')->insert([
                'type_name' => $type
            ]);
        }
    }
}
