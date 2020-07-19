<?php
namespace app\modules\api\controllers;

use yii\rest\ActiveController;
use app\modules\api\resources\ProfileResource;


class ProfileController extends ActiveController
{
    public $modelClass = ProfileResource::class;
  
}