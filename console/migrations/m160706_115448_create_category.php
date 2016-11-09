<?php

use console\migrations\Migration;

class m160706_115448_create_category extends Migration
{
    public function up()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ], self::TABLE_OPTIONS);
    }

    public function down()
    {
        $this->dropTable('category');
    }
}
