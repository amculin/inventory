<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%transaction_reports}}`.
 */
class m250320_075535_create_transaction_reports_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "CREATE TABLE {{%transaction_reports}} (
            `id` smallint UNSIGNED NOT NULL,
            `product_id` smallint UNSIGNED NOT NULL,
            `quantity` tinyint UNSIGNED NOT NULL,
            `report_date` date NOT NULL,
            `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` datetime DEFAULT NULL,
            `created_by` tinyint UNSIGNED NOT NULL,
            `updated_by` tinyint UNSIGNED DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

        $this->execute($sql);

        $alterSql = "ALTER TABLE {{%transaction_reports}}
            ADD PRIMARY KEY (`id`),
            ADD KEY `transaction_reports-index-product_id` (`product_id`)";
        
        $this->execute($alterSql);

        $autoIncrementSql = "ALTER TABLE {{%transaction_reports}}
            MODIFY `id` smallint UNSIGNED NOT NULL AUTO_INCREMENT";
        
        $this->execute($autoIncrementSql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%transaction_reports}}');
    }
}
