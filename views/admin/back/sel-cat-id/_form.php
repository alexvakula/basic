<?php

use app\models\Category;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\SelCatId */
/* @var $form yii\widgets\ActiveForm */
$request = Yii::$app->request;
?>

<div class="sel-cat-id-form">

    <?php $form = ActiveForm::begin(); ?>

  <?= $form->field($model, 'executor_id')->hiddenInput(['value'=>$request->get('id')])->label(false); ?>


    <?= $form->field($model, 'category_id')->dropDownList(Category::find()->select(['name', 'id'])->indexBy('id')->column()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Редагувати', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
