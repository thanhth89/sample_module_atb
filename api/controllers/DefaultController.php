<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/22/2015
 * Time: 10:21 AM
 */

namespace api\controllers;

use yii\web\Controller;
use Yii;

class DefaultController extends Controller
{
    public function actions()
    {
        return 'API';
    }

    public function actionError()
    {
        $result = [
            'error_code' => 401,
            'error_message' => 'Request not found'
        ];
        echo json_encode($result);
        return;
    }
}