<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m200718_152311_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'title' => $this->string(12)->notNull()->unique(),
            'active' => $this->boolean()->defaultValue(true)->notNull(),
            'created_by' => $this->integer(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_by' => $this->integer(),
            'updated_at' => $this->timestamp(),
        ]);

        //index for active
        $this->createIndex(
          'idx-product-title',
          'product',
          'title'
        );
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
