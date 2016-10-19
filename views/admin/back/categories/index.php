<?php

use app\models\Category;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\admin\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категорії';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Створити категорію', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',

           [
                'label' => 'Назва категорії',
                'attribute' => 'id',
                'filter' => Category::find()->select(['name', 'id'])->indexBy('id')->column(),
                'value' => 'name',
            ],            
            [
                'attribute' => 'parent_id',
                'filter' => Category::find()->select(['name', 'id'])->orderBy('parent_id ASC')->indexBy('id')->column(),
                'value' => 'parent.name',
            ],
            [
                'label' => 'Executors',
                'attribute' => 'executors_count',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
