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
 * @property string $g_img
 * @property string $is_show
 * @property integer $u_id
 * @property string $token
 * @property string $url
 */
class MyGongs extends \yii\db\ActiveRecord
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
            [['g_id', 'u_id'], 'integer'],
            [['g_name', 'g_secret', 'g_desc', 'g_img', 'is_show', 'token', 'url'], 'string', 'max' => 255],
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
            'g_name' => 'G Name',
            'g_id' => 'G ID',
            'g_secret' => 'G Secret',
            'g_desc' => 'G Desc',
            'g_img' => 'G Img',
            'is_show' => 'Is Show',
            'u_id' => 'U ID',
            'token' => 'Token',
            'url' => 'Url',
        ];
    }
       

   public function seach($perPage)
    {
        $query = $this->find()->select('*')->innerJoin('my_user','my_gong.u_id=my_user.u_id');
      
        $g_name = Yii::$app->request->post('g_name');
        if($user)
        {
            $query->andFilterWhere(['like','g_name',$g_name]);
        }
        $page = new Pagination([

            'totalCount' => $query->count(),
            'pageSize' => $perPage,
             
            ]);
        $models = $query
        ->offset($page->offset)
        ->limit($page->limit)
        ->asArray()
        ->all();
        // print_r($models);die();
        return[
            'data'=>$models,
            'page'=>$page,
        ];

    }
}
