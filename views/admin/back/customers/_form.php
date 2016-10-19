<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

  <!--  <?= $form->field($model, 'id')->textInput() ?> -->

    <?= $form->field($model, 'name')->label('Ім\'я замовника')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'address')->label('Адреса замовника')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'tel')->label('Телефон замовника')->textarea(['rows' => 1]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
