<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\models\User;
use Yii;
use yii\helpers\Console;

class AppController extends Controller
{

    public function actionAddUser($username, $password){

        $user = new User();
        $security = Yii::$app->getSecurity();
        $user->username = $username;
        $user->password = $security->generatePasswordHash($password);
        $user->access_token = $security->generateRandomString(255);
        if($user->save()){
            Console::output("saved");
        }
        else {
            var_dump($user->errors);
            Console::output("Error");
        }
    }
}
