<?php

use yii\db\Migration;

/**
 * Handles the relation creation of table `{{%users}}`.
 */
class m250320_065930_create_relations_on_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "ALTER TABLE {{%users}} ADD CONSTRAINT `fk-users-to-roles-id` FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`)
                ON DELETE NO ACTION ON UPDATE CASCADE;
            ALTER TABLE {{%users}} ADD CONSTRAINT `fk-users-to-master_units-id` FOREIGN KEY (`unit_id`) REFERENCES `master_units`(`id`)
                ON DELETE NO ACTION ON UPDATE CASCADE;
            ALTER TABLE {{%users}} ADD CONSTRAINT `fk-users-to-users-id` FOREIGN KEY (`created_by`) REFERENCES `users`(`id`)
                ON DELETE NO ACTION ON UPDATE CASCADE;";

        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("ALTER TABLE {{%users}} DROP FOREIGN KEY `fk-users-to-roles-id`");
        $this->execute("ALTER TABLE {{%users}} DROP FOREIGN KEY `fk-users-to-master_units-id`");
        $this->execute("ALTER TABLE {{%users}} DROP FOREIGN KEY `fk-users-to-users-id`");
    }
}
