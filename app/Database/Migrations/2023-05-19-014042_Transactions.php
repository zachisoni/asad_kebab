<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transactions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 12,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 12,
                'null' => true,
                'unsigned' => true,
            ],
            'employee_id' => [
                'type' => 'INT',
                'constraint' => 12,
                'unsigned' => true,
            ],
            'menu_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'amount' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'cost' => [
                'type' => 'FLOAT',
            ]
            ,
            'total_cost' => [
                'type' => 'FLOAT'
            ],
            'timestamp' => [
                'type' => 'TIMESTAMP',
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id');
        $this->forge->addForeignKey('employee_id', 'users', 'id');
        $this->forge->addForeignKey('menu_id', 'menus', 'id');
        $this->forge->createTable('selling');

        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 12,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'menu_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'amount' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'cost' => [
                'type' => 'FLOAT',
            ],
            'total_cost' => [
                'type' => 'FLOAT'
            ],
            'timestamp' => [
                'type' => 'TIMESTAMP',
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('menu_id', 'menus', 'id');
        $this->forge->createTable('buying');

    }

    public function down()
    {
        $this->forge->dropTable('selling');
        $this->forge->dropTable('buying');
    }
}
