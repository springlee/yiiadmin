<?php
/**
 * 权限控制器
 * Created by PhpStorm.
 * User: xu.gao
 * Date: 2016/1/25
 * Time: 11:02
 */

namespace backend\controllers\Admin;



use backend\controllers\BaseController;
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
    /**
     * 角色列表
     */
    public function actionRolelist(){

        $request = Yii::$app->request;

        if($request->isAjax){

            //查询条件
            $params['search']   = $request->post('searchPhrase','');
            $sort               = $request->post('sort');
            $params['sort']     = key($sort).' '.$sort[key($sort)];
            $params['pageIndex']= $request->post('current',1);
            $params['pageSize'] = $request->post('rowCount',10);
            $params['type']     = '1';
            $data               = $this->roleservice->roleList($params);
            $totalCount         = $this->roleservice->roleCount($params);
            $json_data = array(
                "current"        => intval( $params['pageIndex'] ),
                "rowCount"       => intval( $params['pageSize'] ),
                "total"          => intval( $totalCount ),
                "rows"           => $data
            );
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $json_data;
        }
        return $this->render('rolelist');
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
    public function actionRoledelete(){

           $name = Yii::$app->request->post('name','');
           $ret  = $this->roleservice->deleteRole(['name'=>$name,'type'=>1]);
           Yii::$app->response->format = Response::FORMAT_JSON;
           return ResponseUtils::response_data($ret,'删除');
    }

}