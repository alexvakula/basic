<?php

use app\models\Category;
use app\models\Tag;
use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
use yii\widgets\ActiveForm;
use app\models\Executor;
/* @var $this yii\web\View */
/* @var $model app\models\Executor */
/* @var $values app\models\Value[] */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="executor-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


    <div class="row">

            <div class="col-sm-3">
          <?= $form->field($model, 'imageFile')->fileInput(['accept' => 'image/*']) ?>
           <?= Html::img($model->photo, $options = ['height' => 200 ]);?>
           </div>
           <div class="col-sm-5">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'address')->textInput() ?>

            <?= $form->field($model, 'tel')->textInput() ?>
            <?= $form->field($model, 'pasnum')->textInput() ?>
            <?= $form->field($model, 'paskim')->textInput() ?>
		<?= $form->field($model, 'pasdate')->widget(\yii\widgets\MaskedInput::className(), [
		    'mask' => '99/99/9999',
		]); ?>
            <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'rate')->radioList([
                                                            '1' => '1', 
                                                            '2' => '2', 
                                                            '3' => '3', 
                                                            '4' => '4', 
                                                            '5' => '5']) ?>

            <?= $form->field($model, 'active')->checkbox() ?>

            <?php /*$form->field($model, 'tagsArray')->checkboxList(Tag::find()->select(['name', 'id'])->indexBy('id')->column())*/ ?>
 	        </div>
        <div class="col-sm-4">
            <?php foreach ($values as $value): ?>
                <?= $form->field($value, '[' . $value->executorAttribute->id . ']value')->label($value->executorAttribute->name); ?>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Редагувати', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
