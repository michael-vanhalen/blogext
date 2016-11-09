<?php

use console\migrations\Migration;

class m160719_173824_add_column_slug extends Migration
{
    public function up()
    {
        $this->addColumn('article', 'slug', 'string');
    }

    public function down()
    {
        $this->dropColumn('article', 'slug');
    }
}
