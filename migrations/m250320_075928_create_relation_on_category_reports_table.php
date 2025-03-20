<?php

use yii\db\Migration;

/**
 * Handles the relation creation of table `{{%category_reports}}`.
 */
class m250320_075928_create_relation_on_category_reports_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = " ALTER TABLE {{%category_reports}} ADD CONSTRAINT `fk-category_reports-to-master_categories-id` FOREIGN KEY (`category_id`)
                REFERENCES `master_categories`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
            ALTER TABLE {{%category_reports}} ADD CONSTRAINT `fk-category_reports-to-users-id` FOREIGN KEY (`created_by`)
                REFERENCES `users`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE;";

        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("ALTER TABLE {{%category_reports}} DROP FOREIGN KEY `fk-category_reports-to-master_categories-id`");
        $this->execute("ALTER TABLE {{%category_reports}} DROP FOREIGN KEY `fk-category_reports-to-users-id`");
    }
}
