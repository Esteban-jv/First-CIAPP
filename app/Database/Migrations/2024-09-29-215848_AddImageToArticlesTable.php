<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddImageToArticlesTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('articles', [
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('articles', 'image');
    }
}
