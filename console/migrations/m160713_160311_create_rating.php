<?php

use console\migrations\Migration;

class m160713_160311_create_rating extends Migration
{
    public function up()
    {
        $this->createTable('rating', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'article_id' => $this->integer(),
            'value' => $this->integer()->notNull(),
        ], self::TABLE_OPTIONS);
    }

    public function down()
    {
        $this->dropTable('rating');
    }
}
