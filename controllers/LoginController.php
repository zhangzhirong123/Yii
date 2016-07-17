<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use  yii\web\Session;
use app\models\User;
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
            // print_r($data);die();
    		$model->attributes = Yii::$app->request->post();

            if($model -> validate())
            {   
                $data=User::find()->asArray()->where(['user' => $data['username']])->one();
                // print_r($data);die();
                $session = Yii::$app->session;
                $session->open();
                $session->set('userInfo', $data);
                $this->redirect(['index/index']);  
            }
            else
            {
                // var_dump($model->getErrors());die;
                return $this->renderPartial('index',['error'=>$model->getErrors()]);
            }
    		
    	}
    	else
    	{
    		return $this->renderPartial('index');
    	}
        
    }

    /**
     * 退出
     */
    public function actionOut()
    {
        $session = Yii::$app->session;
        // $session->remove('userInfo');
        unset($session['userInfo']);
         // $this->redirect(['login/index']);
        echo "<script>parent.location.href='index.php?r=login/index'</script>"; 
    }
}
