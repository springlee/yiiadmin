<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/17
 * Time: 12:35
 */
//Auth service
Yii::$container->set('frontend\\services\\auth\\IAuthService', 'frontend\\services\\auth\\Impl\\AuthServiceImpl');
Yii::$container->set('authservice','frontend\\services\\auth\\IAuthService');


