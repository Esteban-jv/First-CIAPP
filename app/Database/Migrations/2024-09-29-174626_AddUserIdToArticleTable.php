<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserIdToArticleTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('articles', [
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
        ]);

        $this->updateArticlesIfExist();

        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE',
            'CASCADE','article_user_id_fk');
        $this->forge->processIndexes('articles', 'article_user_id_fk');
    }

    public function down()
    {
        $this->forge->dropForeignKey('articles', 'article_user_id_fk');
        $this->forge->dropColumn('articles', 'user_id');
    }

    private function updateArticlesIfExist()
    {
        $sql = "SELECT id FROM users LIMIT 1";
        $result = $this->db->query($sql)->getResult();

        if($result)
        {
            $sql = "UPDATE articles SET user_id = {$result[0]->id} WHERE user_id IS NULL";
            $this->db->query($sql);
        }
    }
}
