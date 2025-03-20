<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%outbound_transactions}}`.
 */
class m250320_060702_create_outbound_transactions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "CREATE TABLE {{%outbound_transactions}} (
            `id` int UNSIGNED NOT NULL,
            `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
            `product_id` smallint UNSIGNED NOT NULL,
            `quantity` tinyint UNSIGNED NOT NULL,
            `base_price` decimal(10,2) UNSIGNED NOT NULL,
            `sale_price` decimal(10,2) UNSIGNED NOT NULL,
            `discount` decimal(10,2) UNSIGNED DEFAULT '0.00',
            `tax` decimal(10,2) UNSIGNED DEFAULT '0.00',
            `final_price` decimal(10,2) UNSIGNED NOT NULL,
            `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` datetime DEFAULT NULL,
            `created_by` tinyint UNSIGNED NOT NULL,
            `updated_by` tinyint UNSIGNED DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

        $this->execute($sql);

        $alterSql = "ALTER TABLE {{%outbound_transactions}}
            ADD PRIMARY KEY (`id`),
            ADD UNIQUE KEY `outbound_transactions-unique-code` (`code`),
            ADD KEY `outbound_transactions-index-product_id` (`product_id`)";
        
        $this->execute($alterSql);

        $autoIncrementSql = "ALTER TABLE {{%outbound_transactions}}
            MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT";
        
        $this->execute($autoIncrementSql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%outbound_transactions}}');
    }
}
