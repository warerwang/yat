<?php

use yii\db\Schema;
use yii\db\Migration;

class m150121_153211_user_tables extends Migration
{
    public function up()
    {
        $this->execute(<<<EOF
        CREATE TABLE IF NOT EXISTS `users` (
    `id` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` char(32) NOT NULL,
  `salt` char(8) NOT NULL,
  `group_id` tinyint(4) NOT NULL DEFAULT '0',
  `nickname` varchar(50) NOT NULL,
  `access_token` char(32) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `access_token` (`access_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
EOF
);
    }

    public function down()
    {
        echo "m150121_153211_user_tables cannot be reverted.\n";

        return false;
    }
}
