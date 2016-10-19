<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\admin\search\SelCatIDSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sel-cat-id-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'executor_id') ?>

    <?= $form->field($model, 'category_id') ?>

    <div class="form-group">
        <?= Html::submitButton('??????', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('???????', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
