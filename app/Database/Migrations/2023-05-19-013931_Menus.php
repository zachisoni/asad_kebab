<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Menus extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'type_name' => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('types');
        
        if(ENVIRONMENT != 'production'){
            $seeder = \Config\Database::seeder();
            $seeder->call('TypesSeeder');
        }

        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'menu_name' => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ],
            'menu_type' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'price' => [
                'type' => 'FLOAT'
            ],
            'menu_image' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true
            ],
            'init_amount' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'selling' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true
            ],
            'buying' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true
            ],
            'fin_amount' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'details' => [
                'type' => 'TEXT',
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '11',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('menu_type', 'types', 'id');
        $this->forge->createTable('menus');

    }

    public function down()
    {
        $this->forge->dropTable('types');
        $this->forge->dropTable('menus');
    }
}
