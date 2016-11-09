<?php

use console\migrations\Migration;
use yii\db\Schema;

class m161018_152652_create_profile extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%profile}}', [
            'user_id' => Schema::TYPE_INTEGER . ' PRIMARY KEY',
            'name' => Schema::TYPE_STRING . '(255)',
            'avatar' => Schema::TYPE_STRING . '(255)',
            'location' => Schema::TYPE_STRING . '(255)',
            'website' => Schema::TYPE_STRING . '(255)',
            'bio' => Schema::TYPE_TEXT,
            'timezone' => Schema::TYPE_STRING . '(40)',
        ], self::TABLE_OPTIONS);

        $this->addForeignKey('fk_user_profile', '{{%profile}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropTable('{{%profile}}');
    }
}
