<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">首页</a></li>
    <li><a href="#">添加规则</a></li>
    </ul>
    </div>
    
    <div class="formbody">
    
    <div class="formtitle"><span>添加规则</span></div>
    <form action="?r=rules/add" method="post">
    <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
    <ul class="forminfo">
    <li><label>公众号名称</label>
        
    <select name="g_name" class="dfinput">
        <?php
        foreach($data as $val){
        ?>
            <option value="<?php echo $val['id'] ?>"><?php echo $val['g_name'] ?></option>
        <?php
            }
        ?>
    </select>
    
    <i></i></li>
    <li><label>回复规则名称</label><input name="rname" type="text" class="dfinput" /><i>回复规则名称不能超过30个字符</i></li>
    <li><label>触发关键字</label><input name="rword" type="text" class="dfinput" /><i>多个关键字用,隔开</i></li>
    <li><label>回复内容</label><textarea name="rcontent" cols="" rows="" class="textinput"></textarea></li>
    <li><label>&nbsp;</label><input name="" type="submit" class="btn" value="确认保存"/></li>
    </ul>
    </form>
    
    </div>


</body>

</html>
