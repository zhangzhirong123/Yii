<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class InstallController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;
    public function actionIndex(){
       //安装界面如果安装好之后生成一个php文件 文件如果存在则跳到登录界面
        if(is_file("assets/ok.php")){
            $this->redirect(array('/login/index'));
        }else{
            return $this->renderPartial("one");
        }
    }
    public function actionOne1(){
        return $this->renderPartial("one");
    }
    public function actionOne(){
        return $this->renderPartial("index");
    }
    public function actionTwo(){
        return $this->renderPartial("three");
    }
    public function actionCheck(){
        $post=\Yii::$app->request->post();
        // print_r($post);die();
        $host=$post['dbhost'];
        $name=$post['dbname'];
        $pwd=$post['dbpwd'];
        $db=$post['db'];
       $uname=$post['uname'];
       $upwd=$post['upwd'];
       // $dbtem=$post['dbtem'];
        if (@$link= mysql_connect("$host","$name","$pwd")){
            $db_selected = mysql_select_db("$db", $link);
                if($db_selected){
                    $sql="drop database ".$post['db'];
                    mysql_query($sql);
                }
                $sql="create database ".$post['db'];
                mysql_query($sql);
                $file=file_get_contents('./assets/yii.sql');
                $arr=explode('-- ----------------------------',$file);
                $db_selected = mysql_select_db($post['db'], $link);
                for($i=0;$i<count($arr);$i++){
                    if($i%2==0){
                        $a=explode(";",trim($arr[$i]));
                        array_pop($a);
                        foreach($a as $v){
                            mysql_query($v);
                        }
                    }
                }
           
            // var_dump($tables);die(); 
            //修改表前缀 
            // $tables = mysql_list_tables("$db");       
            // while($name = mysql_fetch_array($tables)) {

            // $table = $dbtem.$name['0'];

            // mysql_query("rename table $name[0] to $table");
            // }

                    


                $str="<?php
					return [
						'class' => 'yii\db\Connection',
						'dsn' => 'mysql:host=".$post['dbhost'].";dbname=".$post['db']."',
						'username' => '".$post['dbname']."',
						'password' => '".$post['dbpwd']."',
						'charset' => 'utf8',
						'tablePrefix' => 'my_',   
					];";
                file_put_contents('../config/db.php',$str);

            $str1="<?php
                \$pdo=new PDO('mysql:127.0.0.1= $host;dbname=$db','$name','$pwd',array(PDO::MYSQL_ATTR_INIT_COMMAND=>'set names utf8'));
                   ?>";
            file_put_contents('./assets/abc.php',$str1);
               $sql="insert into my_user (user,poss) VALUES ('$uname','$upwd')";
                mysql_query($sql);
            mysql_close($link);
            $counter_file       =   'assets/ok.php';//文件名及路径,在当前目录下新建aa.txt文件
            $fopen                     =   fopen($counter_file,'wb');//新建文件命令
            fputs($fopen,   'aaaaaa ');//向文件中写入内容;
            fclose($fopen);
            $strs=str_replace("//'db' => require(__DIR__ . '/db.php'),","'db' => require(__DIR__ . '/db.php'),",file_get_contents("../config/web.php"));
            file_put_contents("../config/web.php",$strs);
            $this->redirect(array('/login/index'));
        }else{
            echo "<script>
                        if(alert('数据库账号或密码错误')){
                             location.href='index.php?r=install/two';
                        }else{
                            location.href='index.php?r=install/two';
                        }
            </script>";
        }
    }

}