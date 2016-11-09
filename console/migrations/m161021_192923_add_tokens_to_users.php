<?php

use console\migrations\Migration;

class m161021_192923_add_tokens_to_users extends Migration
{
    public function safeUp()
    {
        $this->addColumn('user', 'password_reset_token', 'string(80)');
        $this->addColumn('user', 'access_token', 'string(80)');

    }

    public function safeDown()
    {
        $this->dropColumn('user', 'password_reset_token');
        $this->dropColumn('user', 'access_token');
    }
}
