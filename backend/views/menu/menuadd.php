<?php

use yii\helpers\Url;
use yii\helpers\Html;
use backend\assets\AppAsset;
AppAsset::addScript($this,'@web/custom/menu.js');

?>
<div class="ibox float-e-margins">
    <?php if(Yii::$app->session->get('msg')){ ?>
        <div class="alert alert-<?=Yii::$app->session->get('type')?> alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <?=Yii::$app->session->get('msg')?>
        </div>
        <?php Yii::$app->session->set('msg','');Yii::$app->session->set('type',''); ?>
    <?php }?>
    <?= Html::beginForm([Url::toRoute('/menu/menuadddone')],'post',['class'=>'form-horizontal']) ?>
    <div class="ibox-title">
        <h5>添加菜单</h5>
    </div>
    <div class="ibox-content">
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">菜单名称</label>
            <div class="col-sm-5">
                <div <?php if(array_key_exists('name',$error)) echo 'class="has-error"';?> >
                    <div class="fg-line">
                        <?= Html::input('text', 'name',isset($model->name) ? $model->name : '',['class' => 'form-control input-sm','placeholder'=>'菜单名称']) ?>
                        <?php if(array_key_exists('name',$error)){ ?>
                            <span class="help-block m-b-none"><?php echo $error['name'][0] ?></span>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">访问地址</label>
            <div class="col-sm-5">
                <div <?php if(array_key_exists('url',$error)) echo 'class="has-error"';?> >
                    <div class="fg-line">
                        <?= Html::input('text', 'url',isset($model->url) ? $model->url : '',['class' => 'form-control input-sm','placeholder'=>'控制器访问地址']) ?>
                        <?php if(array_key_exists('url',$error)){ ?>
                            <span class="help-block m-b-none"><?php echo $error['url'][0] ?></span>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">上级菜单</label>
            <div class="col-sm-5">
                <div <?php if(array_key_exists('parent_id',$error)) echo 'class="has-error"';?> >
                    <div class="fg-line">
                        <select name="parent_id" class="form-control input-sm select2">
                            <option value="0" selected>父级菜单</option>
                            <?php  foreach ($menus as $item): ?>
                                <option value="<?=$item['id']?>"><?=$item['name']?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if(array_key_exists('parent_id',$error)){ ?>
                            <span class="help-block m-b-none"><?php echo $error['parent_id'][0] ?></span>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">权限选择</label>
            <div class="col-sm-5">
                <div <?php if(array_key_exists('slug',$error)) echo 'class="has-error"';?> >
                    <div class="fg-line">
                        <select name="slug" class="form-control input-sm select2">
                            <option value="" selected>权限选择</option>
                            <?php foreach ($permissionList as $item): ?>
                                <option value="<?=$item['name']?>"><?=$item['description'].'--'.$item['name']?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if(array_key_exists('slug',$error)){ ?>
                            <span class="help-block m-b-none"><?php echo $error['slug'][0] ?></span>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">菜单描述</label>
            <div class="col-sm-5">
                <div <?php if(array_key_exists('description',$error)) echo 'class="has-error"';?> >
                    <div class="fg-line">
                        <?= Html::input('text', 'description',isset($model->description) ? $model->description : '',['class' => 'form-control input-sm','placeholder'=>'菜单描述']) ?>
                        <?php if(array_key_exists('description',$error)){ ?>
                            <span class="help-block m-b-none"><?php echo $error['description'][0] ?></span>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">提交</button>
            </div>
        </div>
    </div>
    <?= Html::endForm() ?>
</div>