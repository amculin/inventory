<?php

use yii\db\Migration;

/**
 * Handles the relation creation of table `{{%outbound_transactions}}`.
 */
class m250320_074603_create_relations_on_outbound_transactions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = " ALTER TABLE {{%outbound_transactions}} ADD CONSTRAINT `fk-outbound_transactions-to-master_products-id` FOREIGN KEY (`product_id`)
                REFERENCES `master_products`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
            ALTER TABLE {{%outbound_transactions}} ADD CONSTRAINT `fk-outbound_transactions-to-users-id` FOREIGN KEY (`created_by`)
                REFERENCES `users`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE;";

        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("ALTER TABLE {{%outbound_transactions}} DROP FOREIGN KEY `fk-outbound_transactions-to-master_products-id`");
        $this->execute("ALTER TABLE {{%outbound_transactions}} DROP FOREIGN KEY `fk-outbound_transactions-to-users-id`");
    }
}
