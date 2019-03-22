<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/22/2015
 * Time: 10:21 AM
 */

namespace api\controllers;

use api\models\Amount;
use api\models\Transaction;
use common\components\Encryption;
use common\components\Utility;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use Yii;


class ChargeController extends Controller
{
    public function init()
    {
    }

    public function actionIndex()
    {
        $return ['code'] = 0;
        $return ['message'] = 'Success';
        //get params
        $data = ArrayHelper::getValue($_GET, 'data', '');
        $signature = ArrayHelper::getValue($_GET, 'signature', '');
        $data = rawurlencode($data);
        $signature = rawurlencode($signature);

        if (empty($data) || empty($signature)) {
            $return ['message'] = 'Required params {data,signature}';
            Utility::renderJson($return);
        }
        //check authenticate
        $enc = new Encryption();
        $verify = $enc->verify($data, $signature);
        if (!$verify) {
            $return ['message'] = 'Invalid signature';
            Utility::renderJson($return);
        }
        //decompile
        $data_decompile = $enc->decrypt($data);
        $data_decompile = json_decode($data_decompile, true);
        //check valid data input

        if (empty($data_decompile['msisdn']) || empty($data_decompile['price'])
            || empty($data_decompile['action']) || empty($data_decompile['request_id'])
        ) {
            $return ['message'] = 'Not found params {msisdn,price,action,request_id}';
            Utility::renderJson($return);
        }

        //check is number viettel
        if (!Utility::isRightMSISDN($data_decompile['msisdn'])) {
            $return ['message'] = 'Number invalid';
            Utility::renderJson($return);
        }
        //check balance
        $info = Amount::checkBalance($data_decompile['msisdn'], $data_decompile['price']);
        if (!$info) {
            $return ['message'] = 'Not enough money';
            Utility::renderJson($return);
        }
        //check loop request
        $checkExist = Transaction::checkAlreadyProcess($data_decompile['request_id']);
        if ($checkExist) {
            $return ['message'] = 'Error:request many times';
            Utility::renderJson($return);
        }

        //charge money and log transaction
        $info->money = $info->money - $data_decompile['price'];
        if ($info->save(false)) {
            $log_params['request_id'] = $data_decompile['request_id'];
            $log_params['msisdn'] = $data_decompile['msisdn'];
            $log_params['price'] = $data_decompile['price'];
            $log_params['action'] = $data_decompile['action'];
            Transaction::logTransaction($log_params);
        }

        Utility::renderJson($return);
    }

}