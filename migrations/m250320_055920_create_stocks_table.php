<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%stocks}}`.
 */
class m250320_055920_create_stocks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "CREATE TABLE {{%stocks}} (
            `unit_id` tinyint UNSIGNED NOT NULL,
            `product_id` smallint UNSIGNED NOT NULL,
            `stock` tinyint UNSIGNED NOT NULL,
            `is_deleted` tinyint UNSIGNED NOT NULL,
            `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` datetime DEFAULT NULL,
            `created_by` tinyint UNSIGNED NOT NULL,
            `updated_by` tinyint UNSIGNED DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

        $this->execute($sql);

        $alterSql = "ALTER TABLE {{%stocks}}
            ADD PRIMARY KEY (`unit_id`,`product_id`),
            ADD KEY `stock-index-is_deleted` (`is_deleted`)";
        
        $this->execute($alterSql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%stocks}}');
    }
}
