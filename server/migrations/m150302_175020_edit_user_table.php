<?php

use yii\db\Schema;
use yii\db\Migration;

class m150302_175020_edit_user_table extends Migration
{
    public function up ()
    {
        $this->alterColumn('{{users}}', 'nickname', 'VARCHAR(50) DEFAULT NULL');
        $this->createIndex("email", '{{users}}', 'email', true);
    }

    public function down ()
    {
        $this->alterColumn('{{users}}', 'nickname', 'VARCHAR(50) NOT NULL');
        $this->dropIndex("email", '{{users}}');
    }
}
