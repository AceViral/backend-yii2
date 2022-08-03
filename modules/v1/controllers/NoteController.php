<?php

namespace app\modules\v1\controllers;

use app\helpers\AuthMethodsFromParamsHelper;
use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;

class NoteController extends ActiveController
{
    public $modelClass = 'app\models\Note';

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
            'cors' => [
                'Access-Control-Allow-Origin' => ['*'],
                'Access-Control-Request-Method' => ['POST', 'PUT', 'OPTIONS', 'GET', 'DELETE'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Headers' => ['Authorization'],
                'Access-Control-Max-Age' => 3600,
                'Access-Control-Expose-Headers' => ['*'],
            ],
        ];
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::class,
            'authMethods' => AuthMethodsFromParamsHelper::authMethods(),
        ];
        return $behaviors;
    }

    protected function verbs()
    {
       return [
           'note' => ['POST', 'PUT', 'OPTIONS', 'GET', 'DELETE'],
        //    'note/create' => ['POST', 'PUT', 'OPTIONS', 'GET', 'DELETE'],
       ];
    }
}