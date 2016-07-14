<?php

namespace app\controllers;

class ToolsController extends \yii\web\Controller
{
	/**
	 * 常用工具
	 */
    public function actionIndex()
    {
        return $this->renderPartial('index');
    }
    /**
     * 工作台
     */
    public function actionWork()
    {
        return $this->renderPartial('work');
    }
    /**
     * 模块
     */
    public function actionModular()
    {
    	return $this->renderPartial('modular');
    }
    /**
     * 模型
     */
    public function actionModel()
    {
    	return $this->renderPartial('model');
    }
    /**
     * 模型
     */
    public function actionFile()
    {
    	return $this->renderPartial('file');
    }
}
