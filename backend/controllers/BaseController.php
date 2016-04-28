<?php

namespace backend\controllers;


use yii\web\Controller;
use Yii;
class BaseController extends Controller{


     public $layout='other';

    /**
     * 重写父类的render方法
     * @param string $view
     * @param array $params
     * @return string
     */
    public  function render($view, $params = [])
    {
        $param           = ['model' =>[],'error'=>[]];
        $params          = array_merge($param,$params);
        return parent::render($view, $params);
    }


    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    public function actionError(){

        return $this->render("error");
    }



}