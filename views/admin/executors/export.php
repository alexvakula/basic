<?php

use app\models\Category;
use app\models\Executor;
// use app\models\SelCatId;
use app\models\Tag;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel \app\models\admin\search\ExecutorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Виконавці';
//$this->params['breadcrumbs'][] = $this->title;
Pjax::begin();
?>
<div class="executor-export">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    </p>

<?php $gridColumns = [
//    ['class' => 'yii\grid\SerialColumn'],
    'tel',
    'name',
//    ['class' => 'yii\grid\ActionColumn'],
];

// Renders a export dropdown menu
echo ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns
]);

// You can choose to render your own GridView separately
echo \kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns
]); ?>
</div>
<?php Pjax::end(); ?>