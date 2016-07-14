<?php

namespace app\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "my_gong".
 *
 * @property integer $id
 * @property string $g_name
 * @property integer $g_id
 * @property string $g_secret
 * @property string $g_desc
 */
class MyGong extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'my_gong';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['g_id'], 'integer'],
            [['g_name', 'g_secret', 'g_desc'], 'string', 'max' => 255],
            [['g_name', 'g_secret', 'g_desc','g_id'], 'required'],
            [['g_img'], 'file', 'extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png',],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'g_name' => '公众号名称',
            'g_id' => 'Appid',
            'g_secret' => 'Appsecret',
            'g_desc' => '内容',
            'g_img' => '图片',
        ];
    }
        /**
     * 分页
     */
    public function seach($perPage)
    {
        $query = $this->find()->where(['is_show'=>0]);
        $g_name = Yii::$app->request->post('g_name');
        if($user)
        {
            $query->andFilterWhere(['like','g_name',$g_name]);
        }
        $page = new Pagination([

            'totalCount' => $query->count(),
            'pageSize' => $perPage,
             
            ]);
        $models = $query->offset($page->offset)->limit($page->limit)->all();
        return[
            'data'=>$models,
            'page'=>$page,
        ];

    }
}

