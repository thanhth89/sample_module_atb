<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "amount".
 *
 * @property integer $id
 * @property string $msisdn
 * @property integer $money
 * @property string $created_time
 * @property string $updated_time
 */
class AmountDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'amount';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['msisdn', 'money'], 'required'],
            [['money'], 'integer'],
            [['created_time', 'updated_time'], 'safe'],
            [['msisdn'], 'string', 'max' => 25]
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
            'money' => 'Money',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
        ];
    }
}
