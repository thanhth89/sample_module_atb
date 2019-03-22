<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "transaction".
 *
 * @property integer $id
 * @property string $msisdn
 * @property string $request_id
 * @property string $action
 * @property integer $price
 * @property string $created_time
 */
class TransactionDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['msisdn','request_id', 'action', 'price', 'created_time'], 'required'],
            [['price'], 'integer'],
            [['created_time'], 'safe'],
            [['msisdn'], 'string', 'max' => 25],
            [['action'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'msisdn' => 'Msisdn',
            'action' => 'Action',
            'price' => 'Price',
            'created_time' => 'Created Time',
        ];
    }
}
