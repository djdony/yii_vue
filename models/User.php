<?php

namespace app\models;

use \yii\web\IdentityInterface;
use Yii;

class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'backend_user';
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username'], 'required'],
            [['firstname', 'lastname', 'email'], 'string', 'max' => 250],
            [['username'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 255],
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
            'lastname' => 'Lastname',
            'email' => 'Email',
            'username' => 'Username',
            'password' => 'Password',
        ];
    }


    /**
     * @inheritDoc
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * @inheritDoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::find()->andWhere(['access_token'=> $token])->one();
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getAuthKey()
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function validateAuthKey($authKey)
    {
        return false;
    }

    public static function findByUsername($username)
    {
        return self::findOne(['username'=>$username]);
    }

    public  function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password,$this->password);
    }
}