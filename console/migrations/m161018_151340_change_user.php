<?php

use console\migrations\Migration;
use yii\db\Schema;

class m161018_151340_change_user extends Migration
{
    public function up()
    {
        $this->dropTable('{{%user}}');

        $this->createTable('{{%user}}', [
            'id' => Schema::TYPE_PK,
            'username' => Schema::TYPE_STRING . '(255) NOT NULL',
            'email' => Schema::TYPE_STRING . '(255) NOT NULL',
            'password_hash' => Schema::TYPE_STRING . '(60) NOT NULL',
            'auth_key' => Schema::TYPE_STRING . '(32) NOT NULL',
            'confirmed_at' => Schema::TYPE_INTEGER,
            'unconfirmed_email' => Schema::TYPE_STRING . '(255)',
            'blocked_at' => Schema::TYPE_INTEGER,
            'registration_ip' => Schema::TYPE_STRING . '(45)',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'flags' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
        ], self::TABLE_OPTIONS);

        $this->createIndex('user_unique_username', '{{%user}}', 'username', true);
        $this->createIndex('user_unique_email', '{{%user}}', 'email', true);

    }

    public function down()
    {
        $this->dropTable('{{%user}}');
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ], self::TABLE_OPTIONS);
    }

}
