<?php

use yii\db\Migration;

/**
 * Handles the relation creation of table `{{%master_categories}}`.
 */
class m250320_071659_create_relations_on_master_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = " ALTER TABLE {{%master_categories}} ADD CONSTRAINT `fk-master_categories-to-users-id` FOREIGN KEY (`created_by`)
            REFERENCES `users`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE;";

        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("ALTER TABLE {{%master_categories}} DROP FOREIGN KEY `fk-master_categories-to-users-id`");
    }
}
