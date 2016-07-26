<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "my_sucai".
 *
 * @property integer $id
 * @property string $g_name
 * @property string $fname
 * @property string $fword
 * @property string $filename
 * @property string $fcontent
 * @property integer $uid
 * @property string $link
 */
class MySucai extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'my_sucai';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid'], 'integer'],
            [['g_id', 'fname', 'fword', 'filename', 'fcontent', 'link','title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'g_id' => 'G Name',
            'fname' => 'Fname',
            'fword' => 'Fword',
            'filename' => 'Filename',
            'fcontent' => 'Fcontent',
            'uid' => 'Uid',
            'link' => 'Link',
            'title'=>'Title',
        ];
    }
}
