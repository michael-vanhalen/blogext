<?php

use console\migrations\Migration;

class m160715_155732_add_column_viewings extends Migration
{
    public function up()
    {
        $this->addColumn('article', 'viewings', 'integer');
    }

    public function down()
    {
        $this->dropColumn('article', 'viewings');
    }
}
