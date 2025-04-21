<?php

return [
    [
        'unit_id' => 1,
        'role_id' => 1,
        'username' => 'system',
        'email' => 'system@email.fake',
        'password' => '*****',
        'name' => 'System',
        'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
        'created_by' => 1
    ],
    [
        'unit_id' => 1,
        'role_id' => 2,
        'username' => 'admin',
        'email' => 'admin@email.fake',
        'password' => Yii::$app->getSecurity()->generatePasswordHash('Abcde!2345'),
        'name' => 'Administrator',
        'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
        'created_by' => 1
    ]
];
