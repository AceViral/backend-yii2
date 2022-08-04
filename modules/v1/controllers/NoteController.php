<?php

namespace app\modules\v1\controllers;

use app\helpers\AuthMethodsFromParamsHelper;
use yii\rest\ActiveController;

use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;

class NoteController extends ActiveController
{
    public $modelClass = 'app\models\Note';

    public function behaviors(){
        $behaviors = parent::behaviors();
        unset($behaviors['authenticator']);
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
            'cors' => [
                'Access-Control-Allow-Origin' => ['*'],
                'Access-Control-Request-Method' => ['POST', 'PUT', 'OPTIONS', 'GET', 'DELETE'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Headers' => ['Authorization','Content-Type'],
                'Access-Control-Max-Age' => 3600,
                'Access-Control-Expose-Headers' => ['*'],
            ],
        ];
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                HttpBasicAuth::className(),
                HttpBearerAuth::className(),
                QueryParamAuth::className(),
            ],
        ];
        return $behaviors;
    }

    protected function verbs()
    {
       return [
           'note' => ['POST', 'PUT', 'OPTIONS', 'GET', 'DELETE']
       ];
    }
}