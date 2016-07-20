<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vote".
 *
 * @property integer $v_id
 * @property string $v_titlle
 * @property string $v_time
 * @property string $v_num
 * @property string $v_status
 */
class Vote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vote';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['v_titlle', 'v_status'], 'string', 'max' => 255],
            [['v_time'], 'string', 'max' => 12],
            [['v_num'], 'string', 'max' => 11]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'v_id' => 'V ID',
            'v_titlle' => 'V Titlle',
            'v_time' => 'V Time',
            'v_num' => 'V Num',
            'v_status' => 'V Status',
        ];
    }
}
