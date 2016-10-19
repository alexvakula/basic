<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SelCatId */

$this->title = 'Create Sel Cat Id';
$this->params['breadcrumbs'][] = ['label' => 'Sel Cat Ids', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sel-cat-id-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
