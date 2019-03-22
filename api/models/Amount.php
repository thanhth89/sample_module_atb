<?php

namespace api\models;

use Yii;


class Amount extends \common\models\AmountBase
{

    public static function checkBalance($msisdn, $price)
    {
        $one = self::findOne(['msisdn' => $msisdn]);
        if ($one && $one->money >= $price) {
            return $one;
        }
        return false;
    }

}