<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\admin\search\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'executor_id') ?>

    <?= $form->field($model, 'customer_id') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'task') ?>

    <?php // echo $form->field($model, 'score') ?>

    <?php // echo $form->field($model, 'feedback') ?>

    <?php // echo $form->field($model, 'photo_before') ?>

    <?php // echo $form->field($model, 'photo_after') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
