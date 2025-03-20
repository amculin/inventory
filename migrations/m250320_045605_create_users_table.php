<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m250320_045605_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "CREATE TABLE {{%users}} (
            `id` tinyint UNSIGNED NOT NULL,
            `unit_id` tinyint UNSIGNED NOT NULL,
            `role_id` tinyint UNSIGNED NOT NULL,
            `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
            `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
            `password` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
            `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
            `is_blocked` tinyint UNSIGNED NOT NULL DEFAULT '0' COMMENT '0 = False; 1 = True;',
            `is_deleted` tinyint UNSIGNED NOT NULL DEFAULT '0' COMMENT '0 = False; 1 = True;',
            `auth_key` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
            `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` datetime DEFAULT NULL,
            `created_by` tinyint UNSIGNED NOT NULL,
            `updated_by` tinyint UNSIGNED DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

        $this->execute($sql);

        $alterSql = "ALTER TABLE {{%users}}
            ADD PRIMARY KEY (`id`),
            ADD UNIQUE KEY `user-unique-username` (`username`),
            ADD UNIQUE KEY `user-unique-email` (`email`),
            ADD KEY `user-index-unit_id` (`unit_id`),
            ADD KEY `user-index-role_id` (`role_id`),
            ADD KEY `user-index-is_deleted` (`is_deleted`)";
        
        $this->execute($alterSql);

        $autoIncrementSql = "ALTER TABLE {{%users}}
            MODIFY `id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1";
        
        $this->execute($autoIncrementSql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
