<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Category;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class='form-group field-attribute-parentId'>
    <?= Html::label('Parent', 'parent', ['class' => 'control-label']);?>
    <?= Html::dropdownList(
        'Category[parentId]',
        $model->parentId,
        Category::getTree($model->id),
        ['prompt' => 'Не має головної (корнева)', 'class' => 'form-control']
    );?>

    </div>

    <?= $form->field($model, 'position')->textInput(['type' => 'number']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Створити') : Yii::t('app', 'Зберегти'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
