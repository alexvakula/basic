<?php

//use app\models\Category;
//use app\models\Executor;
use yii\helpers\Html;
//use yii\helpers\ArrayHelper;
//use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = 'Редагування замовлення: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
