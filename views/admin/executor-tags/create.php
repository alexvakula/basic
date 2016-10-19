<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ExecutorTag */

$this->title = 'Create Executor Tag';
$this->params['breadcrumbs'][] = ['label' => 'Executor Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="executor-tag-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
