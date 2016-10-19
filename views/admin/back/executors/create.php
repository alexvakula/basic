<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Executor */

$this->title = 'Новий виконавець';
//$this->params['breadcrumbs'][] = ['label' => 'Executors', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="executor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'values' => $values,
    ]) ?>

</div>
