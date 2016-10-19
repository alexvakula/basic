<?php

use app\models\Category;
use app\models\Executor;
// use app\models\SelCatId;
use app\models\Tag;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel \app\models\admin\search\ExecutorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Виконавці';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="executor-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Додати виконавця', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',

            [
                'label' => 'Категорії',
                'attribute' => 'category_id',
                'filter' => Category::find()->select(['name', 'id'])->indexBy('id')->column(),
                'value' => function (Executor $executor) {
                        return implode(', ', ArrayHelper::map($executor->category, 'id', 'name'));
                    },
            ],
            'name',
            'address:ntext',
            'tel:ntext',
//            'content:ntext',
            'rate',
            [
                'label' => 'Tags',
                'attribute' => 'tag_id',
                'filter' => Tag::find()->select(['name', 'id'])->indexBy('id')->column(),
                'value' => function (Executor $executor) {
                        return implode(', ', ArrayHelper::map($executor->tags, 'id', 'name'));
                    },
            ],
            [
                'attribute' => 'active',
                'filter' => [0 => 'Нет', 1 => 'Да'],
                'format' => 'boolean',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
