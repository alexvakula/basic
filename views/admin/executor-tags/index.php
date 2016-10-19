<?php

use app\models\Executor;
use app\models\Tag;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\admin\search\ExecutorTagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Executor Tags';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="executor-tag-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Executor Tag', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            [
                'attribute' => 'executor_id',
                'filter' => Executor::find()->select(['name', 'id'])->indexBy('id')->column(),
                'value' => 'executor.name',
            ],
            [
                'attribute' => 'tag_id',
                'filter' => Tag::find()->select(['name', 'id'])->indexBy('id')->column(),
                'value' => 'tag.name',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
