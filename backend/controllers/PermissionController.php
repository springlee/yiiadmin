<?php

namespace backend\controllers;


use backend\tools\Flush;
use backend\tools\ResponseUtils;
use Yii;
use yii\web\Response;

class PermissionController extends BaseController{

    private $permissionservice;

    public function init(){

        $this->permissionservice = Yii::createObject('permissionservice');
    }
    /**
     * 权限列表
     */
    public function actionPermission(){
        return $this->render('permissionlist');
    }
    /**
     * 权限列表
     */
    public function actionPermissionlist(){
        $request = Yii::$app->request;
        $params['search']   = $request->get('searchPhrase','');
        $sort               = $request->get('sort','created_at');
        $order              = $request->get('order','');
        $params['sort']     = $sort.' '.$order;
        $params['offset']   = $request->get('offset',0);
        $params['pageSize'] = $request->get('limit',10);
        $params['type']     = '2';
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
     * 添加权限
     */
    public function actionPermissionadd(){


        return $this->render('permissionadd');
    }
    /**
     * 添加权限处理
     */
    public function actionPermissionadddone(){

        $request = Yii::$app->request;

        $model   =  $this->permissionservice->addPermission($request->post());

        if($model->errors){

            return $this->render('permissionadd',['model'=>$model,'error'=>$model->errors]);

        }else{
                Flush::success('添加成功');
                return $this->render('permissionadd');
        }
    }
    /**
     * 更新权限数据
     */
    public function actionPermissionupdate($name){

        $model = $this->permissionservice->queryPermission(['name'=>$name,'type'=>2]);

        return $this->render('permissionupdate',['model'=>$model]);
    }
    /**
     * 更新权限数据处理
     */
    public function actionPermissionupdatedone(){
        $request = Yii::$app->request;
        $model   = $this->permissionservice->updatePermission($request->post());
        if($model->errors){
            return $this->render('permissionupdate',['model'=>$model,'error'=>$model->errors]);
        }else{
            return $this->redirect(array('/permission/permission'));
        }
    }
    /**
     * 删除权限数据
     */
    public function actionPermissiondelete($name){
        $ret = $this->permissionservice->deletePermission(['name'=>$name,'type'=>2]);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ResponseUtils::response_data($ret,'删除');
    }
}