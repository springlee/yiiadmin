<?php
/**
 * Created by PhpStorm.
 * User: xu.gao
 * Date: 2016/1/18
 * Time: 11:07
 */

namespace backend\controllers;


use backend\controllers;
use yii\web\Response;
use backend\tools\ResponseUtils;
use backend\tools\Flush;
use Yii;
use yii\helpers\ArrayHelper;

class UserController extends BaseController
{

    private $userService;
    private $roleService;
    /**
     * 初始化
     */
    public function init()
    {
        $this->userService = Yii::createObject('userservice');
        $this->roleService = Yii::createObject('roleservice');
    }

    public function actionUser(){
        return $this->render('userlist');
    }
    /**
     * 用户列表
     * @return string
     */
    public function actionUserlist(){
        $request = Yii::$app->request;
            //查询条件
            $params['search']   = $request->post('searchPhrase','');
            $sort               = $request->post('sort','');
            $order              = $request->post('order','');
            $params['sort']     = $sort.' '.$order;
            $params['pageIndex']= $request->post('offset',0);
            $params['pageSize'] = $request->post('limit',10);
            $data               = $this->userService->userList($params);
            $totalCount         = $this->userService->userCount($params);
            $json_data = array(
                "total"          => intval( $totalCount ),
                "rows"           => $data
            );
        Yii::$app->response->format = Response::FORMAT_JSON;
     return $json_data;
    }
    /**
     * 用户添加页面
     */
    public function actionUseradd(){

        //查询角色列表
        $roleList = $this->roleService->queryAllRoleByWhere(['type'=>1]);

        return $this->render('useradd',['roleList'=>$roleList]);
    }
    /**
     * 用户添加处理
     */
    public function actionUseradddone(){

        $request = Yii::$app->request;
        //查询角色列表
        $roleList = $this->roleService->queryAllRoleByWhere(['type'=>1]);
        if($request->isPost) {
            $model = $this->userService->addUser($request->post());
            if(is_object($model)){
                return $this->render('useradd',['model'=>$model,'error'=>$model->errors,'roleList'=>$roleList]);
            }else{
                Flush::success('添加成功');
                return $this->render('useradd',['roleList'=>$roleList]);
            }
        }
    }
    /**
     * 用户更新界面
     */
    public function actionUserupdate($id){

        $model = $this->userService->getUserById($id);
        //查询角色列表
        $roleList = $this->roleService->queryAllRoleByWhere(['type'=>1]);
        //查询当前用户所拥有的角色
        $roles = ArrayHelper::toArray(Yii::$app->authManager->getAssignments($id));
        $roles = array_keys($roles);
        return $this->render('userupdate',['model'=>$model,'roleList'=>$roleList,'roles'=>$roles]);
    }
    /**
     * 用户更新数据处理
     */
    public function actionUserupdatedone(){

        $request = Yii::$app->request;
        if($request->isPost){
            $model = $this->userService->updateUser($request->post());
            if($model->errors){
                return $this->render('userupdate',['model'=>$model,'error'=>$model->errors]);
            }else{
                Flush::success('更新成功');
                //查询角色列表
                $roleList = $this->roleService->queryAllRoleByWhere(['type'=>1]);
                //查询当前用户所拥有的角色
                $roles = ArrayHelper::toArray(Yii::$app->authManager->getAssignments($request->post('id')));
                $roles = array_keys($roles);
                return$this->redirect(array('/user/user'));
            }

        }
    }

    /**
     * 用户删除
     */
    public function actionUserdelete($id){
        $ret = $this->userService->deleteUserById($id);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ResponseUtils::response_data($ret,'删除');
    }

    /**
     * 退出登录
     */
    public function actionLogout(){
        Yii::$app->user->logout(true);
        return$this->redirect(array('/site/login'));
    }


}