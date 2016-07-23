<?php

namespace app\controllers;

class GerenController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $code=$_GET['code'];
        // 031LNVM615dIvX1GUMN61ahUM61LNVMO
        // echo $code;
        $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=wxb6d81780cf8dfe31&secret=7384eb27f5812a1ae8d5431d17d92350&code=".$code."&grant_type=authorization_code";
        $json=file_get_contents($url);
        $arr=json_decode($json,true);

        $url1="https://api.weixin.qq.com/sns/userinfo?access_token=".$arr['access_token']."&openid=".$arr['openid']."&lang=zh_CN";
         $json=file_get_contents($url1);
        $arr1=json_decode($json,true);
        return $this->renderPartial('index',['userinfo'=>$arr1]);

        // $usrl2="https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=wxb6d81780cf8dfe31&grant_type=refresh_token&refresh_token=".$arr['refresh_token'];
















        // print_r($arr1);
        // Array ( [openid] => odcqYxLuF0BuqnnRfx8yoSiysXZ8 [nickname] => 志荣 [sex] => 1 [language] => zh_CN [city] => [province] => 北京 [country] => 中国 [headimgurl] => http://wx.qlogo.cn/mmopen/oAR4BfAb7icQ4XMl0lTkvZypiab66tkIjKGAQCcrQOPgUAPibT5PFXIzQnON49CS9IuOzGQLnJqcQYj1sx3lScYYqJwISP1TXJN/0 [privilege] => Array ( ) )




        // Array ( [access_token] => DAnxPBWtjTcdO8sgqUy8s7p_ahTrYQKrAVzYLR8Cu98lA1KNsrHodOUvQo1WOM6jGmjBq9zGLBJwkxodr8B93ALc2OxLmNEvoiH3FAre9sA [expires_in] => 7200 [refresh_token] => kkociavZvX5JtTRtxd57Qnz-FoQSD9uL_T3mQA8xZ172B_eSbRUgagRn4JLQNg7SJiu4kJ8uqajjAz56wNBRppy20sRLgyj_7yez-31syC4 [openid] => odcqYxLuF0BuqnnRfx8yoSiysXZ8 [scope] => snsapi_userinfo )
        // print_r($arr);


  //   	$connection = \Yii::$app->db;
  // 		$command = $connection->createCommand('SELECT * FROM my_gong WHERE id=1');
		// $post = $command->queryOne();
		// // print_r($post);die();
  //       $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$post['g_id']."&redirect_uri=http://www.pentaxiu.com/Yii/web/index.php?r=geren/index&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect";
  //          $ch = curl_init();
  //           curl_setopt($ch, CURLOPT_URL, $url);
  //           curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  //           curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
  //           curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  //           $output = curl_exec($ch);
  //           curl_close($ch);
  //           $jsoninfo = json_decode($output, true);
  // 		print_r($jsoninfo);die();
    }

}


// $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxb6d81780cf8dfe31&redirect_uri=http://www.pentaxiu.com/Yii/web/index.php?r=geren/index&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect';