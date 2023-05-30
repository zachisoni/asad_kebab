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
            'transaction_type' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
            ],
            'total_cost' => [
                'type' => 'INT',
                'constraint' => 12,
                'unsigned' => true,
            ],
            'timestamp' => [
                'type' => 'TIMESTAMP',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id');
        $this->forge->addForeignKey('employee_id', 'users', 'id');
        $this->forge->createTable('transactions');

        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 12,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'transaction_id' =>[
                'type' => 'INT',
                'constraint' => 12,
                'unsigned' => true,
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
            'total_cost' => [
                'type' => 'INT',
                'constraint' => 12,
                'unsigned' => true,
            ],
            
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('menu_id', 'menus', 'id');
        $this->forge->addForeignKey('transaction_id', 'transactions', 'id');
        $this->forge->createTable('sellings');

        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 12,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'transaction_id' =>[
                'type' => 'INT',
                'constraint' => 12,
                'unsigned' => true,
            ],
            'menu_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'price' => [
                'type' => 'INT',
                'constraint' => 12,
                'unsigned' => true,
            ],
            'amount' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'total_cost' => [
                'type' => 'FLOAT'
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('menu_id', 'menus', 'id');
        $this->forge->addForeignKey('transaction_id', 'transactions', 'id');
        $this->forge->createTable('purchases');


    }

    public function down()
    {
        $this->forge->dropTable('sellings');
        $this->forge->dropTable('purchases');
        $this->forge->dropTable('transactions');
    }
}
