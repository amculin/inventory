<?php

use yii\db\Migration;

/**
 * Handles the relation creation of table `{{%master_products}}`.
 */
class m250320_071828_create_relations_on_master_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = " ALTER TABLE {{%master_products}} ADD CONSTRAINT `fk-master_products-to-master_categories-id` FOREIGN KEY (`category_id`)
                REFERENCES `master_categories`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
            ALTER TABLE {{%master_products}} ADD CONSTRAINT `fk-master_products-to-master_brands-id` FOREIGN KEY (`brand_id`)
                REFERENCES `master_brands`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
            ALTER TABLE {{%master_products}} ADD CONSTRAINT `fk-master_products-to-users-id` FOREIGN KEY (`created_by`)
                REFERENCES `users`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE;";

        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("ALTER TABLE {{%master_products}} DROP FOREIGN KEY `fk-master_products-to-master_categories-id`");
        $this->execute("ALTER TABLE {{%master_products}} DROP FOREIGN KEY `fk-master_products-to-master_brands-id`");
        $this->execute("ALTER TABLE {{%master_products}} DROP FOREIGN KEY `fk-master_products-to-users-id`");
    }
}
