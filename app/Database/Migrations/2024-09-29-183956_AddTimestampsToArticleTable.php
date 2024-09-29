<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTimestampsToArticleTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn("articles", [
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('created_at');
        $this->forge->processIndexes('articles', 'article_timestamps');
    }

    public function down()
    {
        $this->forge->dropColumn('articles', 'created_at');
        $this->forge->dropColumn('articles', 'updated_at');
    }
}
