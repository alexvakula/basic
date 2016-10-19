<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Executor */
/* @var $values app\models\Value[] */

$this->title = 'Редагування виконавця: ' . $model->name;
//$this->params['breadcrumbs'][] = ['label' => 'Executors', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="executor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'values' => $values,
    ]) ?>

</div>
