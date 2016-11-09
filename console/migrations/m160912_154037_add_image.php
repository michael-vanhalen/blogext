<?php

use console\migrations\Migration;

class m160912_154037_add_image extends Migration
{
    public function up()
    {
        $this->addColumn('article', 'image', 'string');
    }

    public function down()
    {
        $this->dropColumn('article', 'image');
    }
}
