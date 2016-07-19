<?php

namespace app\controllers;
use Yii;
use app\models\MyGongs;
use  yii\web\Session;
use yii\web\Controller; 
use app\models\ContactForm;
use yii\web\UploadedFile; 
class RulesController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$sql="select * from my_gong ";
        $connection=\Yii::$app->db->createCommand($sql);
        // var_dump($connection);die();
        $data=$connection->queryAll();
        // print_r($data);die();
        return $this->renderPartial('index',['data'=>$data]);
    }
    /**
     * 添加规则
     */
    public function actionAdd()
    {
    	$connection=\Yii::$app->db;
        $arr=\Yii::$app->request->post();
        // print_r($arr);die();
        $connection->createCommand()->insert('my_rules', [
            'g_id' => $arr['g_name'],
            'rname' => $arr['rname'],
            'rword'=>$arr['rword'],
        ])->execute();
        $reid=$connection->getLastInsertID();
        //$reid=$connection->getLastInsertID();
        $connection->createCommand()->insert('my_rules_text', [
            'rid' => "$reid",

            'rcontent'=>$arr['rcontent'],
        ])->execute();
        $this->redirect(['lists']);
	}
	/**
	 * 列表
	 */
	public function actionLists()
	{
		$sql="select * from my_rules INNER  join my_rules_text on my_rules.rid=my_rules_text.rid";
        $connection=\Yii::$app->db->createCommand($sql);
        $arr=$connection->queryAll();
        // print_r($arr);die();
        return $this->renderPartial('lists',['data'=>$arr]);
	}
}
