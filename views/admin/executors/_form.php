<?php

use app\models\Category;
use app\models\City;
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
     <?= $form->field($model, 'city_id')->dropDownList(City::find()
                    ->select(['name', 'id'])
                    ->orderBy('id ASC')
                    ->indexBy('id')
                    ->column(), ['prompt' => 'обрати...']) ?>

            <?= $form->field($model, 'address')->textInput() ?>

            <?= $form->field($model, 'tel')->textInput() ?>
            <?= $form->field($model, 'pasnum')->textInput() ?>
            <?= $form->field($model, 'paskim')->textInput() ?>
            <?= $form->field($model, 'pasdate')->textInput() ?>
            <?= $form->field($model, 'datebirth')->textInput() ?>
            <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'rate')->radioList([
                                                            '1' => '1', 
                                                            '2' => '2', 
                                                            '3' => '3', 
                                                            '4' => '4', 
                                                            '5' => '5']) ?>

            <?= $form->field($model, 'active')->checkbox() ?>


 	        </div>
        <div class="col-sm-4">
            <?php foreach ($values as $value): ?>
                <?= $form->field($value, '[' . $value->executorAttribute->id . ']value')->label($value->executorAttribute->name); ?>
            <?php endforeach; ?>
        </div>
   <?php /* Html::dropdownList(
        'Category[parentId]',
        $model->parentId,
        Category::getTree($model->id),
        ['prompt' => 'Не має головної (корнева)', 'class' => 'form-control']
    );*/?>
`
	<div class="col-sm-12">
            <?php /*$form->field($model, 'tagsArray')->checkboxList(Tag::find()->select(['name', 'id'])->indexBy('id')->column()) */?>
            <?php /* $form->field($model, 'categoriesArray')->checkboxList(Category::find()->select(['name', 'id'])->indexBy('id')->column())*/ ?>
            <?= $form->field($model, 'categoriesArray')->checkboxList(Category::getTree($model->id)) ?>
    	</div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
