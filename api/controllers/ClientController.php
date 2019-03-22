<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/22/2015
 * Time: 10:21 AM
 */

namespace api\controllers;

use common\components\Encryption;
use yii\web\Controller;
use Yii;


class ClientController extends Controller
{

    public function actionIndex()
    {
        $dataSign = json_encode([
            'request_id' => date("YmdHis") . rand(100, 999),
            'msisdn' => '84369803686',
            'price' => '5000',
            'action' => 'streaming',
        ]);
        $enc = new Encryption();
        $data = $enc->encrypt($dataSign);
        $signature = $enc->signature($data);

        $currentDomain = preg_replace('/www\./i', '', $_SERVER['SERVER_NAME']);
        echo $currentDomain."/charge?data=$data&signature=$signature";
    }

}