<?php

use app\models\Category;
use app\models\Executor;
use app\models\Customer;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'customer_id')->dropDownList(Customer::find()
                    ->select(['name', 'id'])
                    ->orderBy('id ASC')
                    ->indexBy('id')
                    ->column(), ['prompt' => 'обрати...']) ?>



    <?= $form->field($model, 'category_id')->dropDownList(Category::find()
                    ->select(['name', 'id'])
                    ->orderBy('id ASC')
                    ->indexBy('id')
                    ->column(), ['prompt' => 'обрати...']) ?>

     <?= $form->field($model, 'executor_id')->dropDownList(Executor::find()
                    ->select(['name', 'id'])
                    ->orderBy('id ASC')
                    ->indexBy('id')
                    ->column(), ['prompt' => 'обрати...']) ?>

    <?= $form->field($model, 'task')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'transport')->checkbox() ?>
    <?= $form->field($model, 'tranprice')->textInput() ?>
    <?= $form->field($model, 'instrument')->checkbox() ?>
    <?= $form->field($model, 'gone')->checkbox() ?>
    <?= $form->field($model, 'done')->checkbox() ?>
    <?= $form->field($model, 'recivedcash')->checkbox() ?>

    <?= $form->field($model, 'score')->radioList([
                                                            '1' => '1', 
                                                            '2' => '2', 
                                                            '3' => '3', 
                                                            '4' => '4', 
                                                            '5' => '5']) ?>

    <?= $form->field($model, 'feedback')->textarea(['rows' => 6]) ?>
<div class="row">
        <div class="col-md-6">
    <?= $form->field($model, 'imageFile1')->fileInput(['accept' => 'image/*']) ?>
    <?= Html::img($model->photo_before, $options = ['height' => 200 ]);?>
    </div>
    <div class="col-md-6">
    <?= $form->field($model, 'imageFile2')->fileInput(['accept' => 'image/*']) ?>
    <?= Html::img($model->photo_after, $options = ['height' => 200 ]);?>
</div></div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
