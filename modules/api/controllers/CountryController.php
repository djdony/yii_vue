<?php
namespace app\modules\api\controllers;

use app\modules\api\resources\CountryResource;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;


class CountryController extends ActiveController
{
    public $modelClass = CountryResource::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['authMethods'] = [
            HttpBearerAuth::class
        ];
        return $behaviors;
    }
  
}