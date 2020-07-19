<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_price}}`.
 */
class m200719_213321_create_product_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_price}}', [
            'id' => $this->primaryKey(),
            'age_group_id' => $this->integer()->null(),
            'policy_period' => $this->integer()->null(),
            'active' => $this->boolean()->defaultValue(true)->notNull(),
            'created_by' => $this->integer(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_by' => $this->integer(),
            'updated_at' => $this->timestamp(),
        ]);

        $this->addForeignKey(
            'fk-age_group_id',
            'product_price',
            'age_group_id',
            'age_group',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_price}}');
    }
}
