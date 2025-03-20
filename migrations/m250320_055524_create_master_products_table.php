<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%master_products}}`.
 */
class m250320_055524_create_master_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "CREATE TABLE {{%master_products}} (
            `id` smallint UNSIGNED NOT NULL,
            `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
            `category_id` tinyint UNSIGNED NOT NULL,
            `brand_id` tinyint UNSIGNED NOT NULL,
            `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
            `base_price` decimal(10,2) UNSIGNED NOT NULL,
            `sale_price` decimal(10,2) UNSIGNED NOT NULL,
            `discount` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
            `tax` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
            `final_price` decimal(10,2) UNSIGNED NOT NULL,
            `is_deleted` tinyint UNSIGNED NOT NULL,
            `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` datetime DEFAULT NULL,
            `created_by` tinyint UNSIGNED NOT NULL,
            `updated_by` tinyint UNSIGNED DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

        $this->execute($sql);

        $alterSql = "ALTER TABLE {{%master_products}}
            ADD PRIMARY KEY (`id`),
            ADD UNIQUE KEY `product-unique-code` (`code`),
            ADD KEY `product-index-is_deleted` (`is_deleted`),
            ADD KEY `product-index-category_id` (`category_id`),
            ADD KEY `product-index-brand_id` (`brand_id`);
            ALTER TABLE {{%master_products}} ADD FULLTEXT KEY `product-fulltext-name` (`name`)";
        
        $this->execute($alterSql);

        $autoIncrementSql = "ALTER TABLE {{%master_products}}
            MODIFY `id` smallint UNSIGNED NOT NULL AUTO_INCREMENT";
        
        $this->execute($autoIncrementSql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%master_products}}');
    }
}
