<?php

use yii\db\Migration;

/**
 * Handles the relation creation of table `{{%master_units}}`.
 */
class m250320_070911_create_relations_on_master_units_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = " ALTER TABLE {{%master_units}} ADD CONSTRAINT `fk-master_units-to-users-id` FOREIGN KEY (`created_by`)
            REFERENCES `users`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE;";

        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("ALTER TABLE {{%master_units}} DROP FOREIGN KEY `fk-master_units-to-users-id`");
    }
}
