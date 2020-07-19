<?php
namespace app\modules\api\controllers;

use app\modules\api\resources\AgeGroupResource;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;


class AgeGroupController extends ActiveController
{
    public $modelClass = AgeGroupResource::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['authMethods'] = [
            HttpBearerAuth::class
        ];
        return $behaviors;
    }
  
}