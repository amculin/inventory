<?php

use yii\db\Migration;

/**
 * Handles the relation creation of table `{{%transaction_reports}}`.
 */
class m250320_080248_create_relation_on_transaction_reports_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = " ALTER TABLE {{%transaction_reports}} ADD CONSTRAINT `fk-transaction_reports-to-master_products-id` FOREIGN KEY (`product_id`)
                REFERENCES `master_products`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
            ALTER TABLE {{%transaction_reports}} ADD CONSTRAINT `fk-transaction_reports-to-users-id` FOREIGN KEY (`created_by`)
                REFERENCES `users`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE;";

        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("ALTER TABLE {{%transaction_reports}} DROP FOREIGN KEY `fk-transaction_reports-to-master_products-id`");
        $this->execute("ALTER TABLE {{%transaction_reports}} DROP FOREIGN KEY `fk-transaction_reports-to-users-id`");
    }
}
