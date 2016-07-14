<?php

namespace app\controllers;
use Yii;
use app\models\MyGong;
use  yii\web\Session;
use yii\web\Controller; 
use app\models\UploadForm;  
use yii\web\UploadedFile;  
class ManageController extends \yii\web\Controller
{
	/**
	 * 添加公众号
	 */
    public $layout='xianmu';
    public function actionAdd()
    {
         $model = new MyGong();
        if(Yii::$app->request->isPost)
        {
            //接受数据
            $data = Yii::$app->request->post();
            //调用上传类
            $file = UploadedFile::getInstance($model, 'g_img');
            //定义路径
            $path='upload/'.date("YmdH",time()).'/';
            if ($file)
            {
                if(!file_exists($path))
                {  
                    mkdir($path,'777',true);
                } 
                //获取后缀
                $ext = $file->getExtension();
                //定义图片名称
                $imageName = time().rand(100,999).'.'.$ext;
                //设置图片的存储位置
                $file->saveAs($path.$imageName);
                //赋值数组
                $data['MyGong']['g_img']=$path.$imageName;
                // print_r($data);die();
                //后台押给model去验证
                $model->attributes = $data['MyGong'];
                if($model->insert())
                    {
                        $this->redirect(['lists']);
                    }else
                    {
                        var_dump($model->getErrors());
                    }
                }
            }
            else
            {
                return $this->render('form',['model'=>$model]);
            }
        
    }
    /**
     * 公众号列表
     */
    public function actionLists()
    {
        // $session = Yii::$app->session;
        // $userInfo = $session->get('userInfo');
        // print_r($userInfo);die();
        $model = new MyGong();
        $data=$model -> seach(5);
        // print_r($data);die();
    	return $this->renderPartial('lists',['data'=>$data]);
    }
    /**
     * 错误页面
     */
    public function actionError()
    {
        return $this->renderPartial('error');
    }
     /**
      * tab
      */
     public function actionTab()
     {
        return $this->renderPartial('tab');
     }
     /**
      * 删除公众号
      */
     public function actionDel($id)
     {
         $model = new MyGong();
         $model -> findOne($id)->delete();
         $this->redirect(['lists']);
     }

}
