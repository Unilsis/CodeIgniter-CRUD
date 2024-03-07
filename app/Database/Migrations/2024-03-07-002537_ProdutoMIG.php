<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProdutoMIG extends Migration {
    public function up() {
        $this->forge->addField([
            'id' => [ 'type' => 'INT', 'constraint' => 255, 'unsigned' => true, 'auto_increment' => true
            ], 'descricao' => [ 'type' => 'VARCHAR', 'constraint' => '200',
            ], 'custo' => [ 'type' => 'DOUBLE'
            ], 'precovenda' => [ 'type' => 'DOUBLE'
            ], 'qtd' => [ 'type' => 'INT'
            ], 'estoque' => [ 'type' => 'INT'
            ], 'created_at' => [ 'type' => ' datetime default current_timestamp', 'null' => true
            ], 'updated_at' => [ 'type' => ' datetime default current_timestamp', 'null' => true
            ], 'deleted_at' => [ 'type' => ' datetime default current_timestamp', 'null' => true
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('produtomods');
    }

    public function down() {
        $this->forge->dropTable('produtomods');
    }
}
