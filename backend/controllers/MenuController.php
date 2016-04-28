<?php
/**
 * Created by PhpStorm.
 * User: xu.gao
 * Date: 2016/1/20
 * Time: 9:16
 */

namespace backend\controllers;


use Yii;
use yii\web\Response;
use backend\controllers;
use backend\tools\ResponseUtils;
use backend\tools\Flush;

class MenuController extends BaseController{


    private $menuService;
    private $permissionService;
    public function init(){
        $this->menuService       = Yii::createObject('menuservice');
        $this->permissionService = Yii::createObject('permissionservice');
    }

    /**
     * 添加菜单
     */
    public function actionMenuadd(){

        //查询父级菜单
        $menus = $this->menuService->queryMenus(['parent_id'=>'0']);
        //查询权限列表
        $permissionList = $this->permissionService->queryAllPermission(['type'=>2]);

        return $this->render('menuadd',['menus' => $menus,'permissionList'=>$permissionList]);
    }
    /**
     * 添加菜单处理
     */
    public function actionMenuadddone(){

        $request = Yii::$app->request;
        $menus = $this->menuService->queryMenus(['parent_id'=>'0']);
        if($request->isPost) {
            //查询权限列表
            $permissionList = $this->permissionService->queryAllPermission(['type'=>2]);
            $model = $this->menuService->menuAdd($request->post());
            if(is_object($model)){
                return $this->render('menuadd',['model'=>$model,'error'=>$model->errors,'menus'=>$menus,'permissionList'=>$permissionList]);
            }else{
                $menus = $this->menuService->queryMenus(['parent_id'=>'0']);
                Flush::success('添加成功');
                return $this->render('menuadd',['menus'=>$menus,'permissionList'=>$permissionList]);
            }
        }
    }
    /**
     * 菜单列表
     */
    public function actionMenu(){
        return $this->render('menulist');
    }

    public function actionMenulist(){
        $request = Yii::$app->request;
        $params['search']   = $request->post('searchPhrase','');
        $sort               = $request->post('sort','');
        $order              = $request->post('order','');
        $params['sort']     = $sort.' '.$order;
        $params['pageIndex']= $request->post('offset',0);
        $params['pageSize'] = $request->post('limit',10);
        $data               = $this->menuService->menuList($params);
        $totalCount         = $this->menuService->menuCount($params);
        $json_data = array(
                "total"          => intval( $totalCount ),
                "rows"           => $data
        );
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $json_data;
    }
    /**
     * 获取菜单的子数据
     */
    public function actionMenuchild(){

        $id     = Yii::$app->request->get('id',0);
        $list   = $this->menuService->queryMenus(['parent_id'=>$id]);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $list;
    }
    /**
     * 更新菜单
     */
    public function actionMenuupdate($id){

        //查询父级菜单
        $menus = $this->menuService->queryMenus(['parent_id'=>'0']);
        //查询当前的菜单信息
        $menu = $this->menuService->menuById($id);
        //查询权限列表
        $permissionList = $this->permissionService->queryAllPermission(['type'=>2]);
        return $this->render('menuupdate',['menus' => $menus,'model'=>$menu,'permissionList'=>$permissionList]);
    }
    /**
     * 更新菜单处理
     */
    public function actionMenuupdatedone(){
            $request = Yii::$app->request;
            $model   = $this->menuService->menuUpdate($request->post());
            if($model->errors){
                //查询父级菜单
                $menus = $this->menuService->queryMenus(['parent_id'=>'0']);
                //查询当前的菜单信息
                $menu = $this->menuService->menuById($request->post('id'));
                //查询权限列表
                $permissionList = $this->permissionService->queryAllPermission(['type'=>2]);
                return $this->render('menuupdate',['menus' => $menus,'model'=>$menu,'permissionList'=>$permissionList]);
            }else{
                return $this->redirect('/menu/menu');
            }
    }
    /**
     * 删除菜单
     */
    public function actionMenudelete(){
        $ret = $this->menuService->menuDelete(Yii::$app->request->get('id',0));
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ResponseUtils::response_data($ret,'删除');
    }
}