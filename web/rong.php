<?php
/**
  * wechat php test
  */

//define your token

$str=$_GET['str'];
include_once("./assets/abc.php");

 

$pdo ->query("set names utf8");
$rs = $pdo->query("SELECT * FROM my_gong where atok ='$str'");
$result_arr = $rs->fetchAll();
// print_r($result_arr);die();
foreach($result_arr as $val){
    $token=$val['token'];
    $tok=$val['atok'];
    $url=$val['aurl'];
    $id=$val['id'];
    $appid=$val['g_id'];
    $appsecret=$val['g_secret'];
}

// define("ID","$id");
// define("TOKEN", "$token");

//验证 服务器和公众平台的钥匙
define("TOKEN", "$token");
define("APPID", "$appid");
define("APPSECRET", "$appsecret");
define("ID","$id");
//查出库里的关键字
// $res=$pdo->query("select rcontent from my_rules inner join my_rules_text on my_rules.rid = my_rules_text.rid where rcontent='荣哥' and g_id=".ID)->fetchAll();
// print_r($res);die(); 


$wechatObj = new wechatCallbackapiTest();
//验证服务器和公众平台建立连接
//如果已经成功建立连接后把该方法注释
// $wechatObj->valid();
//输出服务器返回的信息
$echoStr = $_GET["echostr"];
    if($echoStr)
    {
        $wechatObj->valid($pdo);
    }
    else
    {
        $wechatObj->responseMsg($pdo);
    }

class wechatCallbackapiTest
{
    public function valid($pdo)
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        //连接成功后就直接退出
        if($this->checkSignature()){
            echo $echoStr;
            $this->responseMsg($pdo);
            exit;
        }
    }
    //获得服务器返回的信息
    public function responseMsg($pdo)
    {
        //get post data, May be due to the different environments
        //接受用户及手机端发给服务器的信息，可以接受xml格式的数据
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        //extract post data
        if (!empty($postStr)){
                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                   the best way is to check the validity of xml by yourself */
                //只解析xml实体，不解析xml的结构，防止xxe攻击
                libxml_disable_entity_loader(true);
                //解析xml格式的数据
                $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                //获取发送者的openid
                $fromUsername = $postObj->FromUserName;
                //开发者的微信号
                $toUsername = $postObj->ToUserName;
                //获取用户发送消息的类型
                $msgtype  = $postObj->MsgType;
                //获取发送的文本内容
                $keyword = trim($postObj->Content);
                $time = time();
                //定义发送文本类型的字符串
                $textTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Content><![CDATA[%s]]></Content>
                            <FuncFlag>0</FuncFlag>
                            </xml>";  
                //定义发送数据格式为音乐
                $musicTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Music>
                            <Title><![CDATA[%s]]></Title>
                            <Description><![CDATA[%s]]></Description>
                            <MusicUrl><![CDATA[%s]]></MusicUrl>
                            <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
                            </Music>
                            </xml>";
                 //定义发送图文消息的接口
                $newsTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <ArticleCount>%s</ArticleCount>
                            <Articles>
                            %s
                            </Articles>
                            </xml>";   
                         
            // 判断用户发送数据的格式
            if($msgtype == 'text')
            {
                if(!empty($keyword))
                {
                    $res=$pdo->query("select rcontent from my_rules inner join my_rules_text on my_rules.rid = my_rules_text.rid where rword='$keyword' and g_id= ".ID)->fetchAll();
                    if($res[0]['rcontent'])
                    {
                        $msgType = "text";
                        $contentStr = $res[0]["rcontent"];
                        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        echo $resultStr;
                    }
                    else
                    {

                    //图灵机器人
                    $url="http://www.tuling123.com/openapi/api?key=442806f53bb6af5927aabf5b6e2951e9&info=".$keyword;
                    $json=file_get_contents($url);
                    $arr=json_decode($json,true);
                    
                    $msgType = "text";
                        $contentStr = $arr['text'];
                        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        echo $resultStr;



                       
                    }

                    
                }else{
                      $msgType = "text";
                        $contentStr = "欢迎关注";
                        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        echo $resultStr;
                    // echo "Input something...";
                }
            }
            elseif ($msgtype == 'image') 
            {
                //定义回复的类型
                    $msgType = "text";
                    $contentStr = "你长得太帅啦，我的天啊:)！";
                    //sprintf 格式化字符串
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
            }
            elseif ($msgtype == 'voice') 
            {
                //定义回复的类型
                    $msgType = "text";
                    $contentStr = "声音不错哦";
                    //sprintf 格式化字符串
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
            }
            elseif ($msgtype == 'location') 
            {
                //定义回复的类型
                    $msgType = "text";
                    $contentStr = "正在获取地理位置";
                    //sprintf 格式化字符串
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
            }
                

        }else {
            echo "";
            exit;
        }
    }
        
    private function checkSignature()
    {
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
                
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        
        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
}

?>