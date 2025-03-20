<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category_reports}}`.
 */
class m250320_075119_create_category_reports_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "CREATE TABLE {{%category_reports}} (
            `id` smallint UNSIGNED NOT NULL,
            `category_id` tinyint UNSIGNED NOT NULL,
            `quantity` tinyint UNSIGNED NOT NULL,
            `type` tinyint UNSIGNED NOT NULL COMMENT '1 = In; 2 = Out;',
            `report_date` date NOT NULL,
            `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` datetime DEFAULT NULL,
            `created_by` tinyint UNSIGNED NOT NULL,
            `updated_by` tinyint UNSIGNED DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

        $this->execute($sql);

        $alterSql = "ALTER TABLE {{%category_reports}}
            ADD PRIMARY KEY (`id`),
            ADD KEY `category_reports-index-category_id` (`category_id`)";
        
        $this->execute($alterSql);

        $autoIncrementSql = "ALTER TABLE {{%category_reports}}
            MODIFY `id` smallint UNSIGNED NOT NULL AUTO_INCREMENT";
        
        $this->execute($autoIncrementSql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category_reports}}');
    }
}
