<?php
/**
 * @Date: 26/03/2015
 * @Function: Class xử lý các hàm tiện ích của hệ thống
 * @System: Video 2.0
 */
namespace common\components;

use Yii;
use yii\helpers\Json;

class Utility
{

    /**
     * Check Viettel number
     * @param string $mSISDN
     */
    public static function isRightMSISDN($mSISDN)
    {
        $mSISDN = preg_replace('/^84/', '0', str_replace('+', '', $mSISDN));

        if(preg_match('/^(097|098|096|086|036)\d+/', $mSISDN))
        {
            return strlen($mSISDN) == 10;
        }
        if (preg_match('/^(016)\d+/', $mSISDN))
        {
            return strlen($mSISDN) == 11;
        }
        return false;
    }

    /**
     * @param array $data
     * @return string
     */
    public static function renderJson($data = array())
    {
        $logger = new KLogger('logs' . DS . 'charge' . DS . 'charge_' . date('Ymd'), KLogger::INFO);
        $logger->LogInfo(date('Y-m-d H:i:s') . '|REQUEST=' . json_encode($_REQUEST) . '|response: ' . Json::encode($data));
        //header_remove();
        header('Content-type:application/json; charset=utf-8');
        if (!DEBUG) {
            echo Json::encode($data);
        } else {
            echo Json::encode($data, JSON_PRETTY_PRINT);
        }
        exit;
    }

}