<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Value */

$this->title = $model->executor_id;
$this->params['breadcrumbs'][] = ['label' => 'Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="value-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'executor_id' => $model->executor_id, 'attribute_id' => $model->attribute_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'executor_id' => $model->executor_id, 'attribute_id' => $model->attribute_id], [
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
            [
                'attribute' => 'produce_id',
                'value' => ArrayHelper::getValue($model, 'executor.name'),
            ],
            [
                'attribute' => 'attribute_id',
                'value' => ArrayHelper::getValue($model, 'executorAttribute.name'),
            ],
            'value',
        ],
    ]) ?>

</div>
