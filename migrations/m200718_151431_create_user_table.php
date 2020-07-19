<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%backend_user}}`.
 */
class m200718_151431_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('backend_user', [
            'id' => $this->primaryKey(),
            'firstname' => $this->string(250)->null(),
            'lastname' => $this->string(250)->null(),
            'email' => $this->string(250)->null(),
            'username' => $this->string(50)->notNull(),
            'password' => $this->string(100)->notNull(),
            'access_token' => $this->string(1024)->notNull(),
            'active' => $this->boolean()->defaultValue(true)->notNull(),
            'created_by' => $this->integer()->defaultValue(1)->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_by' => $this->integer(),
            'updated_at' => $this->timestamp(),
        ]);

        // creates index for column `username`
        $this->createIndex(
            'idx-backend_user-username',
            'backend_user',
            'username'
        );

        // creates index for column `email`
        $this->createIndex(
            'idx-backend_user-email',
            'backend_user',
            'email'
        );

    }



    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('backend_user');
    }
}
