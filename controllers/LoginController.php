<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use  yii\web\Session;
class LoginController extends \yii\web\Controller
{
    public function actionIndex()
    {

        if(!is_file("assets/ok.php")){
             $this->redirect(['install/one1']);
        }
            
        $session = Yii::$app->session;
        $userInfo = $session->get('userInfo');
        if($userInfo)
        {
            $this->redirect(['index/index']);
        }
        if(Yii::$app->request->isPost)
    	{
            $model = new LoginForm();

            $data = Yii::$app->request->post();

    		$model->attributes = Yii::$app->request->post();

            if($model -> validate())
            {   
                $session = Yii::$app->session;
                $session->open();
                $session = Yii::$app->session;
                $session->set('userInfo', $data);
                $this->redirect(['index/index']);  
            }
            else
            {
                // var_dump($model->getErrors());

                return $this->renderPartial('index',['error'=>$model->getErrors()]);
            }
    		
    	}
    	else
    	{
    		return $this->renderPartial('index');
    	}
        
    }


}
