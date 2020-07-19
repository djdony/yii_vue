<?php

namespace app\modules\api\models;

use Yii;
use yii\base\Model;
use app\modules\api\resources\UserResource;

class RegisterForm extends Model
{
    public $username;
    public $password;
    public $password_repeat;
    public $user = null;

    public function rules()
    {
        return [
            [['username', 'password', 'password_repeat'], 'required'],
            ['password', 'compare', 'compareAttribute' => 'password_repeat'],
            ['username', 'unique',
                'targetClass' => '\app\modules\api\resources\UserResource',
                'message' => 'This username has already been taken.'
            ],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    public function register()
    {
        if ($this->validate()) {
            $user = new UserResource();
            $user->username = $this->username;
            $user->password = Yii::$app->security->generatePasswordHash($this->password);
            $user->access_token = Yii::$app->security->generateRandomString();
            $this->user = $user;
            if ($user->save()) {
                return Yii::$app->user->login($user, 0);
            }
            return false;
        }
        return false;
    }
}
