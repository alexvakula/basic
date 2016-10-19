<?php

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Замовлення', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

 <!--   <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Редагувати', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',

            [
                'attribute' => 'executor_id',
                'value' => ArrayHelper::getValue($model, 'executor.name'),
                'label' => 'Виконавець'
            ],

            [
                'attribute' => 'customer_id',
                'value' => ArrayHelper::getValue($model, 'customer.name'),
                'label' => 'Замовник'
            ],
            [
                'attribute' => 'category_id',
                'value' => ArrayHelper::getValue($model, 'category.name'),
                'label' => 'Категорія'
            ],
            'task:ntext',
            'score',
            'feedback:ntext',

            [
                'attribute' => 'transport',
                'format' => 'boolean',
            ],
            'tranprice',
            [
                'attribute' => 'instrument',
                'format' => 'boolean',
                'label' => 'Інструмент'
            ],
            'vitratnimat',
            'discount',
            'sumof',
            'sumexec',
            'suma',

            [
                'attribute' => 'gone',
                'format' => 'boolean',
                'label' => 'Виїхав',
            ],
            [
                'attribute' => 'done',
                'format' => 'boolean',
                'label' => 'Завершено роботу'
            ],
            [
                'attribute' => 'recivedcash',
                'format' => 'boolean',
                'label' => 'Отримано готівку'
            ],
            'created_at:date',
            'updated_at:date',


            [
                'attribute' => 'photo_before',
                'format' => ['image', ['height'=>'200']],
                'label' => 'Фото до',
            ],
            [
                'attribute' => 'photo_after',
                'format' => ['image', ['height'=>'200']],
                'label' => 'Фото після',
            ],

        ],
    ]) ?>

</div>
