<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProject extends Migration {
    
    public function up() {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 255,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' => [
                'type' => 'TEXT'
            ],
            'created_at' => [
                'type' => ' datetime default current_timestamp',
                'null' => true
            ],
            'updated_at' => [
                'type' => ' datetime default current_timestamp',
                'null' => true
            ],
            'deleted_at' => [
                'type' => ' datetime default current_timestamp',
                'null' => true
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('projects');
    }

    public function down() {
        $this->forge->dropTable('projects');
    }
}
