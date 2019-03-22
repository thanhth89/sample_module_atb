<?php

namespace common\models;

use Yii;


class TransactionBase extends \common\models\db\TransactionDB
{

    public static function logTransaction($params)
    {
        $default = array(
            'request_id' => 0,
            'msisdn' => 0,
            'action' => '',
            'price' => 0,
            'created_time' => date("Y-m-d H:i:s"),
        );

        $params = array_merge($default, $params);
        $trans = new self();
        $trans->setAttributes($params);
        return $trans->save(false);
    }

    public static function checkAlreadyProcess($request_id)
    {
        $one = self::findOne(['request_id' => $request_id]);
        if (empty($one)) {
            return false;
        }
        return true;
    }


}
