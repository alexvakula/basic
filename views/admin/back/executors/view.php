<?php

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model app\models\Executor */
/* @var $model app\models\SelCatId */

$this->title = $model->name;
//$this->params['breadcrumbs'][] = ['label' => 'Executors', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
$vik = $model->calculate_age($model->datebirth);
?>
<div class="executor-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редагувати', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<div class="col-md-2">
  <?= Html::img($model->photo, $options = ['height' => 200 ]);?>
      
  </div>
<div class="col-md-10">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'address',
		'pasnum',
		'paskim',
		'pasdate',
                'datebirth',
            [
                'label' => 'Вік',
                'value' => $vik,
            ],
                
            'note:ntext',
            'rate',
            'active:boolean',
            [
                'label' => 'Tags',
                'value' => implode(', ', ArrayHelper::map($model->tags, 'id', 'name')),
            ],
        ],
    ]) ?>
</div>
    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider(['query' => $model->getValues()]),
        'layout' => "{items}\n{pager}",
        'columns' => [
            [
                'attribute' => 'attribute_id',
                'value' => 'executorAttribute.name',
            ],
            'value',
        ],
    ]); ?>
    
  <div class="sel-cat-id-index">
    <p>
 <?= Html::a('Додати категорію', ['admin/sel-cat-id/create/', 'id' => $model->id], ['class' => 'btn btn-success']) ?>      
    </p>
    
    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider(['query' => $model->getSelCatId()]),
     //  'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

 //           'id',
 //           'category.name',
            [
                'attribute' => 'Name',
           //     'filter' => SelCatId::find()->select(['name', 'id'])->indexBy('id')->column(),
               'value' => 'category.name',
            ],
         //   'category_id',

            ['class' => 'yii\grid\ActionColumn',
             'controller' => 'admin/sel-cat-id'],
        ],
    ]); ?>
 
    </div>
</div>
