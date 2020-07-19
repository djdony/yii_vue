<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property string $name
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $email
 * @property int|null $status_id
 * @property int|null $country_id
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Country $country
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['status_id', 'country_id'], 'default', 'value' => null],
            [['status_id', 'country_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'address'], 'string', 'max' => 150],
            [['phone'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 250],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'phone' => 'Phone',
            'email' => 'Email',
            'status_id' => 'Status ID',
            'country_id' => 'Country ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Country]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\CountryQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\queryProfileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\queryProfileQuery(get_called_class());
    }
}
