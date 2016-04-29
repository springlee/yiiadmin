<?php

use yii\helpers\Url;
use yii\helpers\Html;
use backend\assets\AppAsset;
AppAsset::addCss($this,'@web/static/style/awesome-bootstrap-checkbox.css');
?>
<div class="ibox float-e-margins">
    <?php if(Yii::$app->session->get('msg')){ ?>
        <div class="alert alert-<?=Yii::$app->session->get('type')?> alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <?=Yii::$app->session->get('msg')?>
        </div>
        <?php Yii::$app->session->set('msg','');Yii::$app->session->set('type',''); ?>
    <?php }?>
    <?= Html::beginForm([Url::toRoute('/role/rolepermissiondone')],'post',['class'=>'form-horizontal']) ?>
    <input type="hidden" name="name" value="<?=$name?>">

    <div class="ibox-title">
        <h5>更新角色权限</h5>
        <div class="ibox-tools">
            <a class="collapse-link" title="返回" href="<?php echo Url::to(['role/role'])?>" >
                <i class="fa fa-chevron-up"></i>
            </a>
        </div>
    </div>
    <div class="ibox-content">
        <?php foreach ($permissionlist as $items): ?>
        <?php
            $names = explode(',',$items['description']);
            $roles = explode(',',$items['name']);
            $len   = count($names);
        ?>
        <div class="fieldset col-xs-9">
            <fieldset class="scheduler-border">
                <legend class="scheduler-border"><?=$items['typename']?></legend>
                    <?php for ($i = 0;$i<$len;$i++): ?>
                        <div class="checkbox checkbox-success checkbox-inline">
                            <input type="checkbox" <?php if(in_array($roles[$i],$roleList)) echo 'checked'; ?> name="roles[]" value="<?=$roles[$i]?>">
                            <label for="checkbox5">
                                <?=$names[$i]?>
                            </label>
                        </div>
                    <?php endfor; ?>
            </fieldset>
        </div>
       <?php endforeach; ?>
        <div class="form-group">
            <div class="col-xs-4 pull-right">
                <button type="submit" class="btn btn-primary">提交</button>
            </div>
        </div>
    </div>

    <?= Html::endForm() ?>
</div>