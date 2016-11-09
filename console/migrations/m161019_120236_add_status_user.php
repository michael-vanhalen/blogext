<?php

use yii\db\Migration;

class m161019_120236_add_status_user extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'status', 'integer');
    }

    public function down()
    {
        $this->dropColumn('user', 'status');
    }
}
