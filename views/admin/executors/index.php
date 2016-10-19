<?php

use app\models\Category;
use app\models\Executor;
// use app\models\SelCatId;
use app\models\Tag;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;
//use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel \app\models\admin\search\ExecutorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Виконавці';
//$this->params['breadcrumbs'][] = $this->title;
Pjax::begin();
?>
<div class="executor-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Додати виконавця', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Експорт CSV', ['export'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
        'columns' => [

//            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'options' => ['width' => '70px']
            ],
            [
                'attribute' => 'name',
                'options' => ['width' => '230px']
            ],

           

            [
                'attribute' => 'address',
                'value' => 'address',
            ],
            [
                'attribute' => 'tel',
                'options' => ['width' => '70px']
            ],

            
//            'content:ntext',
            [
                'label' => 'Категорії',
                'attribute' => 'category_id',
                'filter' => Category::getTree($model->id),
                'value' => function (Executor $executor) {
                        return implode(', ', ArrayHelper::map($executor->category, 'id', 'name'));
                    },
                'options' => ['width' => '250px']
            ], 
 /*  <?= Html::dropdownList(
        'Category[parentId]',
        $model->parentId,
        Category::getTree($model->id),
        ['prompt' => 'Не має головної (корнева)', 'class' => 'form-control']
    );?> */
            [
                'attribute' => 'rate',
                'options' => ['width' => '50px']
            ],
    
            
 /*           [
                'label' => 'Tags',
                'attribute' => 'tag_id',
                'filter' => Tag::find()->select(['name', 'id'])->indexBy('id')->column(),
                'value' => function (Executor $executor) {
                        return implode(', ', ArrayHelper::map($executor->tags, 'id', 'name'));
                    },
            ],  */
            [
                'attribute' => 'active',
                'filter' => [0 => 'Нет', 1 => 'Да'],
                'format' => 'boolean',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<?php Pjax::end(); ?>