<?php

use console\migrations\Migration;

class m160701_111309_create_article extends Migration
{
    public function up()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'admin_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'text' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'avg_rating' => $this->double()->notNull()
        ], self::TABLE_OPTIONS);
    }

    public function down()
    {
        $this->dropTable('article');
    }
}
