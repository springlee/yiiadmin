<?php

namespace backend\controllers;

use backend\tools\Flush;
use backend\tools\ResponseUtils;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Response;

class RoleController extends BaseController{

    private $roleservice;
    private $permissionservice;
    public function init(){

        $this->roleservice       = Yii::createObject('roleservice');
        $this->permissionservice = Yii::createObject('permissionservice');
    }

    public function actionRole(){
        return $this->render('rolelist');
    }

    /**
     * 角色列表
     */
    public function actionRolelist(){
        $request = Yii::$app->request;
        $params['search']   = $request->get('searchPhrase','');
        $sort               = $request->get('sort','created_at');
        $order              = $request->get('order','');
        $params['sort']     = $sort.' '.$order;
        $params['offset']   = $request->get('offset',0);
        $params['pageSize'] = $request->get('limit',10);
        $params['type']     = '1';
        $data               = $this->permissionservice->permissionList($params);
        $totalCount         = $this->permissionservice->permissionCount($params);
        $json_data = array(
            "total"          => intval( $totalCount ),
            "rows"           => $data
        );
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $json_data;
    }
    /**
     * 添加角色
     */
    public function actionRoleadd(){


        return $this->render('roleadd');
    }
    /**
     * 添加角色处理
     *
     */
    public function actionRoleadddone(){
        $request = Yii::$app->request;
        $model   = $this->roleservice->addRole($request->post());
        if($model->errors){
            Flush::danger('添加失败');
            return $this->render('roleadd',['model'=>$model,'error'=>$model->errors]);
        }else{
            Flush::success('添加成功');
            return $this->render('roleadd');
        }
    }
    /**
     * 更新角色数据页面
     */
    public function actionRoleupdate(){

        $roleName = Yii::$app->request->get('name','');
        $role     = $this->roleservice->queryRoleByWhere(['name'=>$roleName,'type'=>1]);
        return $this->render('roleupdate',['model'=>$role]);
    }
    /**
     * 更新角色数据处理
     */
    public function actionRoleupdatedone(){

        $request = Yii::$app->request;

        //print_r($request->post());exit;

        $ret = $this->roleservice->roleUpdate($request->post());

        if($ret){

            Flush::success('角色更新成功');
        }else{

            Flush::danger('操作失败');
        }
        return $this->redirect('/role/roleupdate/'.$request->post('name'));
    }
    /**
     * 更新角色权限
     */
    public function actionRolepermission(){

        $roleName = Yii::$app->request->get('name','');
        //获取当前角色的权限
        $roleList = array_keys(ArrayHelper::toArray(Yii::$app->authManager->getPermissionsByRole($roleName)));
        //查询权限列表
        $list = $this->permissionservice->permissionGroupByTypeName();
        return $this->render('role_permission',['permissionlist'=>$list,'name'=>$roleName,'roleList'=>$roleList]);
    }
    /**
     * 更新角色权限处理
     */
    public function actionRolepermissiondone(){

        $request = Yii::$app->request;

        $ret     = $this->roleservice->assignRole($request->post());

        if($ret){

            Flush::success('权限分配成功');
        }else{

            Flush::danger('操作失败');
        }
        return $this->redirect('/role/rolepermission/'.$request->post('name'));
    }
    /**
     * 删除角色
     */
    public function actionRoledelete($name){
           $ret  = $this->roleservice->deleteRole(['name'=>$name,'type'=>1]);
           Yii::$app->response->format = Response::FORMAT_JSON;
           return ResponseUtils::response_data($ret,'删除');
    }

}