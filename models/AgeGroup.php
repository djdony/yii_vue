<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "age_group".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $min_age
 * @property int|null $max_age
 *
 * @property Product[] $products
 * @property ProductPrice[] $productPrices
 */
class AgeGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'age_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['min_age', 'max_age'], 'default', 'value' => null],
            [['min_age', 'max_age'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['title'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'min_age' => 'Min Age',
            'max_age' => 'Max Age',
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\ProductQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['age_group_id' => 'id']);
    }

    /**
     * Gets query for [[ProductPrices]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\ProductPriceQuery
     */
    public function getProductPrices()
    {
        return $this->hasMany(ProductPrice::className(), ['age_group_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\queryAgeGroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\queryAgeGroupQuery(get_called_class());
    }
}
