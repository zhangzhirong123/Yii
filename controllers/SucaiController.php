<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\MySucai;
use  yii\web\Session;
class SucaiController extends \yii\web\Controller
{

    public function actionIndex()
    {
        $sql="select * from my_gong ";
        $connection=\Yii::$app->db->createCommand($sql);
        // var_dump($connection);die();
        $data=$connection->queryAll();
        return $this->renderPartial('index',['data'=>$data]);
    }

    /**
     * 上传素材
     */
    public function actionAdd()
    {
          $request=Yii::$app->request;
         $memcache = \Yii::$app->cache;
        if($request->isPost){
            $res = Yii::$app->request->post();
            // print_r($res);die();
            // 获取access_token   
            $memcache = \Yii::$app->cache;
            // $memcache->flush();die;
            $access_token=$memcache->get("access_token");
           if(@!$access_token) {
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxf2e8db182cbb9cc8&secret=11041f9973bd50ee4156a048b1de8515";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            $jsoninfo = json_decode($output, true);
            $access_token = $jsoninfo["access_token"];
            $memcache->set("access_token",$access_token,7000);
        }
            //接收图片
            $file=$_FILES['filename'];
            // print_r($file);die;
            $type=substr($file['name'], strrpos($file['name'],'.',-1));
            $newname=date('YmdHis',time()).rand(0,9999).$type;
            $path="./upload/$newname";
            move_uploaded_file($file['tmp_name'],$path);
            $filepath=dirname(__DIR__)."/web/upload/$newname";
                    $filedata = array(  
                        'fieldname'=>'@'.realpath($filepath)   
                    ); 
                $url="https://api.weixin.qq.com/cgi-bin/media/uploadimg?access_token=$access_token"; 
                $result=$this->upload($url,$filedata);//调用upload函数  

                if(isset($result)){
                    $data=json_decode($result);  
                    if(isset($data->url)){  
                        $url=$data->url;//得到url  
                        // echo $url;die();
                    }else{  
                        echo "no media_id!"; die; 
                    }  
                }else{  
                    echo 'error';  die;
                }
                $model = new MySucai();
                $session = Yii::$app->session;
                $userInfo = $session->get('userInfo');
                // print_r($userInfo);die();
                $uid = $userInfo['u_id'];
                // echo $uid;die();
                // print_r($res);die();
                $res['uid']=$uid; 
                $res['link']=$url;
                $res['filename']=$path;
                // print_r($res);die();
                $model->attributes = $res;
                if($model->insert())
                    {

                        $this->redirect(['lists']);
                    }else
                    {
                        var_dump($model->getErrors());
                    }
            return $this->redirect(['lists']);
        }else{
            $account=new Account;
            $arr=$account->find()->asArray()->all();
            return $this->render('addpicture',['arr'=>$arr]);
        }
    }

    /**
     * 展示
     */
    public function actionLists()
    {
        $session = Yii::$app->session;
        $userInfo = $session->get('userInfo');        
        $uid = $userInfo['u_id'];
        // echo $uid;die();
        $sql="select * from my_sucai where uid = $uid";
        $connection=\Yii::$app->db->createCommand($sql);
        $arr=$connection->queryAll();
        // print_r($arr);die();
        return $this->renderPartial('lists',['data'=>$arr]);
    }

    public static function upload($url,$filedata){  
        $curl=curl_init();  
        if(class_exists('/CURLFile')){//php5.5跟php5.6中的CURLOPT_SAFE_UPLOAD的默认值不同  
            curl_setopt($curl,CURLOPT_SAFE_UPLOAD,true);  
        }else{  
            if(defined('CURLOPT_SAFE_UPLOAD')){  
                curl_setopt($curl,CURLOPT_SAFE_UPLOAD,false);  
            }  
        }  
        curl_setopt($curl,CURLOPT_URL,$url);  
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,FALSE);
        if (! empty($filedata)){  
            curl_setopt($curl,CURLOPT_POST,1);  
            curl_setopt($curl,CURLOPT_POSTFIELDS,$filedata);  
        }  
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);  
        $output =curl_exec($curl);  
        curl_close($curl);  
        return $output;  
          
    }
    /**
     * 删除素材
     */
    public function actionDel($id)
    {

          $memcache = \Yii::$app->cache;
            // $memcache->flush();die;
            $access_token=$memcache->get("access_token");
           if(@!$access_token) {
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxf2e8db182cbb9cc8&secret=11041f9973bd50ee4156a048b1de8515";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            $jsoninfo = json_decode($output, true);
            $access_token = $jsoninfo["access_token"];
            $memcache->set("access_token",$access_token,7000);
        }
        // echo $access_token;die();
        $model = new MySucai;
        $sql="select * from my_sucai where id = $id";
        $connection=\Yii::$app->db->createCommand($sql);
        $arr=$connection->queryOne();
        // print_r($arr);die();
        $url="https://api.weixin.qq.com/cgi-bin/material/del_material?access_token=$access_token";
        $media = $arr['link'];
        // echo $media;die(); 
        $filedata = array('media_id'=>$media);
        $filedata = json_encode($filedata,true);
        // echo $filedata;die();
        $result = $this->upload($url, $filedata);
        $result = json_decode($result, true);
        print_r($result);
        // if($result['errcode']==0){
        //     echo "素材删除成功";
        // }elseif ($result['errcode']==40007) {
        //     echo "素材ID不正确";
        // }
        // dump($result);
    }

   

}
