<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use backend\controllers;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class MainController extends BaseController
{
    /**
     * @inheritdoc
     */
    public $layout='other';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('main');
    }

}
