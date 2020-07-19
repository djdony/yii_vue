<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%age_group}}`.
 */
class m200718_140813_create_age_group_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%age_group}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->unique(),
            'min_age' => $this->integer()->null(),
            'max_age' => $this->integer()->null()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%age_group}}');
    }
}
