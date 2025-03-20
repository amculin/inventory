<?php

use yii\db\Migration;

/**
 * Handles the relation creation of table `{{%stocks}}`.
 */
class m250320_073848_create_relations_on_stocks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = " ALTER TABLE {{%stocks}} ADD CONSTRAINT `fk-stocks-to-master_products-id` FOREIGN KEY (`product_id`)
                REFERENCES `master_products`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
            ALTER TABLE {{%stocks}} ADD CONSTRAINT `fk-stocks-to-users-id` FOREIGN KEY (`created_by`)
                REFERENCES `users`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE;";

        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("ALTER TABLE {{%stocks}} DROP FOREIGN KEY `fk-stocks-to-master_products-id`");
        $this->execute("ALTER TABLE {{%stocks}} DROP FOREIGN KEY `fk-stocks-to-users-id`");
    }
}
