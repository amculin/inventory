<?php

use yii\db\Migration;

/**
 * Handles the relation creation of table `{{%master_brands}}`.
 */
class m250320_071206_create_relations_on_master_brands_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = " ALTER TABLE {{%master_brands}} ADD CONSTRAINT `fk-master_brands-to-users-id` FOREIGN KEY (`created_by`)
            REFERENCES `users`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE;";

        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("ALTER TABLE {{%master_brands}} DROP FOREIGN KEY `fk-master_brands-to-users-id`");
    }
}
