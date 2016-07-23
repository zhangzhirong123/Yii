<!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title>个人中心</title>
        <link rel="stylesheet" type="text/css" href="themes/metro/easyui.css">
        <link rel="stylesheet" type="text/css" href="themes/mobile.css">
        <link rel="stylesheet" type="text/css" href="themes/icon.css">
        <script type="text/javascript" src="weixin/jquery.min.js"></script>
        <script type="text/javascript" src="weixin/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="weixin/jquery.easyui.mobile.js"></script>
    </head>
    <body>
        <div class="easyui-navpanel" style="position:relative">
            <header>
                <div class="m-toolbar">
                    <div class="m-title">个人中心</div>
                </div>
            </header>
            <footer>
                <div class="m-buttongroup m-buttongroup-justified" style="width:100%;">
                    <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-large-picture',size:'large',iconAlign:'top',plain:true">个人中心</a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-large-clipart',size:'large',iconAlign:'top',plain:true">搜索</a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-large-shapes',size:'large',iconAlign:'top',plain:true">发表</a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-large-smartart',size:'large',iconAlign:'top',plain:true">电话本</a>
                </div>
            </footer>
            <div style="text-align:center;margin:50px 30px">
                <a href="javascript:void(0)" class="easyui-linkbutton" data-options="plain:true,outline:true" style="width:80px;height:30px" onclick="$('#dlg1').dialog('open').dialog('center')">Click me</a>
            </div>
    
            <div id="dlg1" class="easyui-dialog" style="padding:20px 6px;width:80%;" data-options="inline:true,modal:true,closed:true,title:'Information'">
                <p>
                	<?php
                    echo $userinfo['nickname'];
                    
                    ?>
                    <img src="<?php echo $userinfo['headimgurl']?>" width="80px" heigth="80px"/>	
                </p>
                <div class="dialog-button">
                    <a href="javascript:void(0)" class="easyui-linkbutton" style="width:100%;height:35px" onclick="$('#dlg1').dialog('close')">OK</a>
                </div>
            </div>
        </div>
    </body>
    </html>
