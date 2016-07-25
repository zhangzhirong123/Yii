<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class MenuController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {

        $sql="select * from my_gong ";
        $connection=\Yii::$app->db->createCommand($sql);
        $arr=$connection->queryAll();
        //include ('../views/layouts/menu.php');
        return $this->renderPartial('index',['arr'=>$arr]);
    }
    public function actionAdd(){

    }
    public function actionToken(){
        $db = \Yii::$app->db->createCommand();
        $arr=Yii::$app->request->post();
        // print_r($arr);die();
        // var_dump($arr['do']);
        $id=$arr['di'];
       // var_dump($arr);die;
        $sql="select * from my_gong where id='$id' ";
        $connection=\Yii::$app->db->createCommand($sql);
        $data=$connection->queryAll();
        // print_r($data);die();
        $appid=$data[0]['g_id'];
        $appsecret=$data[0]['g_secret'];
        $memcache = \Yii::$app->cache;
       // $memcache->flush();die;
        $zhi=$memcache->get("zhi");
        // echo $zhi;die();
        if(@!$zhi) {
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            $jsoninfo = json_decode($output, true);
            $access_token = $jsoninfo["access_token"];
            $memcache->set("zhi",$access_token,7000);
        }
        $zhi=$memcache->get("zhi");
        // echo $zhi;die();
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$zhi";
        $method="POST";
        $data=$arr['do'];
        $ch = curl_init();   //1.初始化
        curl_setopt($ch, CURLOPT_URL, $url); //2.请求地址
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);//3.请求方式
        //4.参数如下
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//https
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');//模拟浏览器
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));//gzip解压内容
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');

        if($method=="POST"){//5.post方式的时候添加数据
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);//6.执行

        if (curl_errno($ch)) {//7.如果出错
            return curl_error($ch);
        }
        return $tmpInfo;
        curl_close($ch);//8.关闭
        //$this->redirect(array("index/index"));


    }

      /**
     * 生成二维码
     */
    public function actionErweima()
    {
       $memcache = \Yii::$app->cache;
       // $memcache->flush();die;
        $zhi=$memcache->get("zhi");
        // echo $zhi;die();
        if(@!$zhi) {
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxb6d81780cf8dfe31&secret=7384eb27f5812a1ae8d5431d17d92350";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            $jsoninfo = json_decode($output, true);
            $access_token = $jsoninfo["access_token"];
            $memcache->set("zhi",$access_token,7000);
        }
        $zhi=$memcache->get("zhi");
        // echo $zhi;die();
        $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=$zhi";
        $method="POST";
        $data='{"expire_seconds": 604800, "action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": 123}}}';
        
        $ch = curl_init();   //1.初始化
        curl_setopt($ch, CURLOPT_URL, $url); //2.请求地址
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);//3.请求方式
        //4.参数如下
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//https
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');//模拟浏览器
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));//gzip解压内容
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');

        if($method=="POST"){//5.post方式的时候添加数据
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);//6.执行

        if (curl_errno($ch)) {//7.如果出错
            return curl_error($ch);
        }
        // return $tmpInfo;
        // print_r($tmpInfo);
        curl_close($ch);//8.关闭

        $data = json_decode($tmpInfo,true);
        $ticket = $data['ticket'];
        // echo $ticket;die();
        $url = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=$ticket";
        // $data1 = file_get_contents($url);
        // echo "<a href='$url'>".$url."</a>";
// echo '<img src="$data1" alt="">';
        // echo $data1;
        return $this->renderPartial('lists',['url'=>$url]);
    }
}
