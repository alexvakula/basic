<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\City;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

  <!--  <?= $form->field($model, 'id')->textInput() ?> -->

    <?= $form->field($model, 'name')->label('Ім\'я замовника')->textarea(['rows' => 1]) ?>
      <?= $form->field($model, 'city_id')->dropDownList(City::find()
                    ->select(['name', 'id'])
                    ->orderBy('id ASC')
                    ->indexBy('id')
                    ->column(), ['prompt' => 'обрати...']) ?>

    <?= $form->field($model, 'address')->textInput() ?>

    <?= $form->field($model, 'tel')->textInput() ?>
            <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'rate')->radioList([
                                                            '1' => '1', 
                                                            '2' => '2', 
                                                            '3' => '3', 
                                                            '4' => '4', 
                                                            '5' => '5']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
