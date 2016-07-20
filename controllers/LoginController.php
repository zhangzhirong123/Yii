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
    public $layout = 'xianmu';
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
            $model = new LoginForm();
    		return $this->renderPartial('index',['model'=>$model]);
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

    //验证码方法
 public function actions()
    {       
        return  [   
             //默认的写法
            'captcha' => [
                    'class' => 'yii\captcha\CaptchaAction',
                    'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                    'backColor'=>0xFFF,//背景颜色
                    'maxLength' => 4, //最大显示个数
                    'minLength' => 4,//最少显示个数
                    'padding' => 5,//间距
                    'height'=>40,//高度
                    'width' => 110,  //宽度  
                    // 'transparent'=>true,  //显示为透明 
                    

                    'foreColor'=>0xffff,     //字体颜色
                    'offset'=>4,        //设置字符偏移量 有效果
                    //'controller'=>'login',        //拥有这个动作的controller
                ],
        ];
    }
    /**
 * @用户授权规则
 */
public function behaviors()
{
    return [
           'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup','login'],//这里一定要加
                'rules' => [
                    [
                        'actions' => ['login','captcha'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions'=>['logout','edit','add','del','index','users','thumb','upload','cutpic','follow','nofollow'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
}
