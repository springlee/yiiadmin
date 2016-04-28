<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/17
 * Time: 12:28
 */
namespace frontend\services\auth\Impl;

use frontend\services\auth\IAuthService;
use common\models\LoginForm;
use common\models\UserForm;

class AuthServiceImpl implements IAuthService{


    /**
     * 用户登录验证
     * @param null $params
     * @return mixed
     */
    public function Login($params = null)
    {

        $model = new LoginForm();
        $model->username = $params['username'];
        $model->password = $params['password'];
        if ($model->login()) {

            return true;
        }else{
            return $model;
        }
    }

    public function alert(){
        echo 123;
    }

}