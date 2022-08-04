<?php
namespace app\modules\v1\controllers;

use app\models\Status;
use yii\rest\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return [
            'status' => Status::STATUS_OK,
            'message' => "You may customize this page by editing the following file:". __FILE__,
            'data' => ''
        ];
    }
}
