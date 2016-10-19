<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SelCatId */

$this->title = 'Update Sel Cat Id: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sel Cat Ids', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sel-cat-id-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
