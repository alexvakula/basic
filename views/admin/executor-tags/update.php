<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ExecutorTag */

$this->title = 'Update Executor Tag: ' . $model->executor_id;
$this->params['breadcrumbs'][] = ['label' => 'Executor Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->executor_id, 'url' => ['view', 'executor_id' => $model->executor_id, 'tag_id' => $model->tag_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="executor-tag-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
