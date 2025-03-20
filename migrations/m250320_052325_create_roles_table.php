<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%roles}}`.
 */
class m250320_052325_create_roles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "CREATE TABLE {{%roles}} (
            `id` tinyint UNSIGNED NOT NULL,
            `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
            `name` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
            `is_deleted` tinyint UNSIGNED NOT NULL DEFAULT '0',
            `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` datetime DEFAULT NULL,
            `created_by` tinyint UNSIGNED NOT NULL,
            `updated_by` tinyint DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

        $this->execute($sql);

        $alterSql = "ALTER TABLE {{%roles}}
            ADD PRIMARY KEY (`id`),
            ADD KEY `role-index-is_deleted` (`is_deleted`)";
        
        $this->execute($alterSql);

        $autoIncrementSql = "ALTER TABLE {{%roles}}
            MODIFY `id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT";
        
        $this->execute($autoIncrementSql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%roles}}');
    }
}
