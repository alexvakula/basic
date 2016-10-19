<?php

use app\models\Executor;
use app\models\Tag;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ExecutorTag */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="executor-tag-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'executor_id')->dropDownList(Executor::find()->select(['name', 'id'])->indexBy('id')->column()) ?>

    <?= $form->field($model, 'tag_id')->dropDownList(Tag::find()->select(['name', 'id'])->indexBy('id')->column()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
