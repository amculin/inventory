<?php

use yii\db\Migration;

/**
 * Handles the relation creation of table `{{%roles}}`.
 */
class m250320_070656_create_relations_on_roles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = " ALTER TABLE {{%roles}} ADD CONSTRAINT `fk-roles-to-users-id` FOREIGN KEY (`created_by`) REFERENCES `users`(`id`)
                ON DELETE NO ACTION ON UPDATE CASCADE;";

        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("ALTER TABLE {{%roles}} DROP FOREIGN KEY `fk-roles-to-users-id`");
    }
}
