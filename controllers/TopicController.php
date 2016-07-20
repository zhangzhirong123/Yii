<?php

namespace app\controllers;
use app\models\Vote;
class TopicController extends \yii\web\Controller
{


	//禁用布局文件
	// public $layout = false;
	
	//话题管理
    public function actionIndex()
    {
    	$model = new Vote();
    	$arr = $model->find()->orderBy(['v_num'=>SORT_DESC])->asArray()->all();
        return $this->renderPartial('index',['arr'=>$arr]);
    }

}
