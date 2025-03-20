<?php

use yii\db\Migration;

/**
 * Handles the relation creation of table `{{%inbound_transactions}}`.
 */
class m250320_074349_create_relations_on_inbound_transactions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = " ALTER TABLE {{%inbound_transactions}} ADD CONSTRAINT `fk-inbound_transactions-to-master_products-id` FOREIGN KEY (`product_id`)
                REFERENCES `master_products`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
            ALTER TABLE {{%inbound_transactions}} ADD CONSTRAINT `fk-inbound_transactions-to-users-id` FOREIGN KEY (`created_by`)
                REFERENCES `users`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE;";

        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("ALTER TABLE {{%inbound_transactions}} DROP FOREIGN KEY `fk-inbound_transactions-to-master_products-id`");
        $this->execute("ALTER TABLE {{%inbound_transactions}} DROP FOREIGN KEY `fk-inbound_transactions-to-users-id`");
    }
}
