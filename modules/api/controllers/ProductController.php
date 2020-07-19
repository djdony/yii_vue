<?php
namespace app\modules\api\controllers;

use app\modules\api\resources\ProductResource;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;
use yii\rest\ActiveController;


class ProductController extends ActiveController
{
    public $modelClass = ProductResource::class;

    // public function behaviors()
    // {
    //     $behaviors = parent::behaviors();
    //     $behaviors['authenticator']['authMethods'] = [
    //         HttpBearerAuth::class
    //     ];
    //     return $behaviors;
    // }
  
}