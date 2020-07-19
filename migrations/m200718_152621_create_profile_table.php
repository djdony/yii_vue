<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%profile}}`.
 */
class m200718_152621_create_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('profile', [
            'id' => $this->primaryKey(),
            'name' => $this->string(150)->notNull(),
            'address' => $this->string(150)->null(),
            'phone' => $this->string(50)->null(),
            'email' => $this->string(250)->null(),
            'status_id' => $this->integer()->defaultValue(0),
            'country_id' => $this->integer()->null(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp(),
        ]);

        // creates index for column `license_id`
        $this->createIndex(
            'idx-profile-name',
            'profile',
            'name'
        );

        $this->addForeignKey(
            'fk-country_id',
            'profile',
            'country_id',
            'country',
            'id'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%profile}}');
    }
}
