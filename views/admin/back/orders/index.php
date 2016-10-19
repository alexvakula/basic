<?php

use app\models\Category;
use app\models\Executor;
use app\models\Customer;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\admin\search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Замовлення';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Додати замовлення', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'value' => 'id',
                'label' => 'Номер',
            ],   
            [
                'attribute' => 'executor_id',
                'filter' => Executor::find()->select(['name', 'id'])->orderBy('name ASC')->indexBy('id')->column(),
                'format' => 'text',
                'value' => 'executor.name',
                'label' => 'Виконавець',
            ],
   //         'executor_id',
   //         'customer_id',
            [
                'attribute' => 'customer_id',
                'filter' => Customer::find()->select(['name', 'id'])->orderBy('name ASC')->indexBy('id')->column(),
                'value' => 'customer.name',
                'label' => 'Замовник',
            ],            
            [
                'attribute' => 'category_id',
                'filter' => Category::find()->select(['name', 'id'])->orderBy('parent_id ASC')->indexBy('id')->column(),
                'value' => 'category.name',
                'label' => 'Категорія',
            ],
 //           'category_id',
 //           'task:ntext',
            [
                'attribute' => 'datecr',
                'label' => 'Дата',
            ],
            // 'score',
            // 'feedback:ntext',
            // 'photo_before:ntext',
            // 'photo_after:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
