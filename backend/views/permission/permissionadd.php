<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>
<div class="ibox float-e-margins">
    <?php if(Yii::$app->session->get('msg')){ ?>
        <div class="alert alert-<?=Yii::$app->session->get('type')?> alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <?=Yii::$app->session->get('msg')?>
        </div>
        <?php Yii::$app->session->set('msg','');Yii::$app->session->set('type',''); ?>
    <?php }?>
    <?= Html::beginForm([Url::toRoute('/permission/permissionadddone')],'post',['class'=>'form-horizontal']) ?>
    <div class="ibox-title">
        <h5>添加权限</h5>
    </div>
    <div class="ibox-content">

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">权限类型名称</label>
            <div class="col-sm-5">
                <div <?php if(array_key_exists('typename',$error)) echo 'class="has-error"';?> >
                    <div class="fg-line">
                        <?= Html::input('text', 'typename',isset($model->typename) ? $model->typename : '',['class' => 'form-control input-sm','placeholder'=>'同种类型的权限该字段保持一致']) ?>
                        <?php if(array_key_exists('typename',$error)){ ?>
                                <span class="help-block m-b-none"><?php echo $error['typename'][0] ?></span>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">权限</label>
            <div class="col-sm-5">
                <div <?php if(array_key_exists('name',$error)) echo 'class="has-error"';?> >
                    <div class="fg-line">
                        <?= Html::input('text', 'name',isset($model->name) ? $model->name : '',['class' => 'form-control input-sm','placeholder'=>'权限']) ?>
                        <?php if(array_key_exists('typename',$error)){ ?>
                            <span class="help-block m-b-none"><?php echo $error['name'][0] ?></span>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">描述</label>
            <div class="col-sm-5">
                <div <?php if(array_key_exists('description',$error)) echo 'class="has-error"';?> >
                    <div class="fg-line">
                        <?= Html::input('text', 'description',isset($model->description) ? $model->description : '',['class' => 'form-control input-sm','placeholder'=>'描述']) ?>
                        <?php if(array_key_exists('typename',$error)){ ?>
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