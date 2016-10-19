<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\admin\search\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Замовники послуг';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Додати замовника', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

      //      'id',
            ['attribute' => 'name',
		'label' => 'Ім\'я замовника'],
            ['attribute' => 'address',
		'label' => 'Адреса замовника'],

 //           'address:ntext',
            'tel:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
