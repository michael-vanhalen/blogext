<?php

use console\migrations\Migration;;

class m160706_122329_add_column_article extends Migration
{

    public function up()
    {
        $this->addColumn('article', 'category_id', 'integer');
    }

    public function down()
    {
        $this->dropColumn('article', 'category_id');
    }

}
