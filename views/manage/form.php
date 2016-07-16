<?php if(Yii::$app->session->hasFlash('success')):?>  
    <div class="alert alert-danger">  
    <?=Yii::$app->session->getFlash('success')?>  
    </div>  
<?php endif ?>  
<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
$form = ActiveForm::begin([
   'id'=>'upload',  
        'enableAjaxValidation' => false,  
        'options'=>['enctype'=>'multipart/form-data',
                    'class' => 'form-horizontal'
        ],
        //表单样式
    'fieldConfig'=>[
    'template'=> "{label}\n<div class=\"col-sm-3\">{input}</div>\n{error}",
    'labelOptions' => ['class' => 'col-lg-2 control-label'],//字体左边 
    ]
]) ?>
    <?= $form->field($model, 'g_name') ?>
    <?= $form->field($model, 'g_secret') ?>
    <?= $form->field($model, 'g_id')?>
    <?= $form->field($model, 'g_img')->fileInput(['multiple'=>true]);?> 
    <?= $form->field($model, 'g_desc')->textArea(['rows' => '6']) ?>
    

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('ok', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

<?php ActiveForm::end() ?>