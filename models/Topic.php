<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "topic".
 *
 * @property integer $t_id
 * @property string $t_name
 * @property string $t_url
 * @property string $t_time
 * @property string $status
 */
class Topic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'topic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['t_time'], 'safe'],
            [['t_name', 't_url', 'status'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            't_id' => 'T ID',
            't_name' => 'T Name',
            't_url' => 'T Url',
            't_time' => 'T Time',
            'status' => 'Status',
        ];
    }
}
