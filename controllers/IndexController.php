<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use  yii\web\Session;
class IndexController extends \yii\web\Controller
{
	 // public $layout = false

    public function actionTop()
    {
        $session = Yii::$app->session;
        $userInfo = $session->get('userInfo');
    	return $this->renderPartial('top',['userInfo'=>$userInfo]);
    }

    public function actionLeft()
    {
    	return $this->renderPartial('left');
    }

    public function actionRight()
    {
    	return $this->renderPartial('right');
    }

    public function actionIndex()
    {
        if(!is_file("assets/ok.php")){
             $this->redirect(['install/one1']);
        }
        return $this->renderPartial('index');
    }
   
    /**
     * 首页
     */
    public function actionIndex1()
    {
        return $this->renderPartial('index1');
    }
}
