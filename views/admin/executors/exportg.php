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
use yii\grid\DataColumn;
/* @var $this yii\web\View */
/* @var $searchModel \app\models\admin\search\ExecutorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Виконавці';
//$model->text='text';
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
[
'label' => 'Name',
'attribute' => 'name',
'format' => 'text',
],
 [
'label' => 'Given Name',
'attribute' => 'name',
'format' => 'text',
//'value' => 'text',
], 
[
'label' => 'Additional Name',
'attribute' => 'name',
'format' => 'text',
'value' => null,
], 
[
'label' => 'Family Name',
'attribute' => 'name',
'format' => 'text',
'value' => null,
], 
[
'label' => 'Yomi Name',
'format' => 'text',
'value' => null,
], 
[
'label' => 'Given Name Yomi',
'format' => 'text',
'value' => null,
], 
[
'label' => 'Additional Name Yomi',
'format' => 'text',
'value' => null,
], 
[
'label' => 'Family Name Yomi',
'format' => 'text',
'value' => null,
], 
[
'label' => 'Name Prefix',
'format' => 'text',
'value' => null,
], 
[
'label' => 'Name Suffix',
'format' => 'text',
'value' => null,
], 
[
'label' => 'Initials',
'format' => 'text',
'value' => null,
], 
[
'label' => 'Nickname',
'format' => 'text',
'value' => null,
], 
[
'label' => 'Short Name',
'format' => 'text',
'value' => null,
], 
[
'label' => 'Maiden Name',
'format' => 'text',
'value' => null,
], 
[
'label' => 'Birthday',
'format' => 'text',
'value' => null,
], 
[
'label' => 'Gender',
'format' => 'text',
'value' => null,
], 
[
'label' => 'Location',
'format' => 'text',
'value' => null,
], 
[
'label' => 'Billing Information',
'format' => 'text',
'value' => null,
], 
[
'label' => 'Directory Server',
'format' => 'text',
'value' => null,
], 
[
'label' => 'Mileage',
'format' => 'text',
'value' => null,
], 
[
'label' => 'Occupation',
'format' => 'text',
'value' => null,
], 
[
'label' => 'Hobby',
'format' => 'text',
'value' => null,
], 
[
'label' => 'Sensitivity',
'format' => 'text',
'value' => null,
], 
[
'label' => 'Priority',
'format' => 'text',
'value' => null,
], 
[
'label' => 'Subject',
'format' => 'text',
'value' => null,
], 
[
'label' => 'Notes',
'format' => 'text',
'value' => null,
], 

[
'label' => 'Group Membership',
'format' => 'text',
'value' => null,
], 
[
'label' => 'E-mail 1 - Type',
'format' => 'text',
'value' => null,
], 
[
'label' => 'E-mail 1 - Value',
'format' => 'text',
'value' => null,
], 
[
'label' => 'E-mail 2 - Type',
'format' => 'text',
'value' => null,
], 
[
'label' => 'E-mail 2 - Value',
'format' => 'text',
'value' => null,
], 
[
//'class' => DataColumn::className(), // this line is optional
'label' => 'Phone 1 - Type',
'format' => 'raw',
'attribute' => 'phonet',
],
[

'label' => 'Phone 1 - Value',
'attribute' => 'tel',
'format' => 'text',
    
], 
  	
[
'label' => 'Phone 2 - Type',
'format' => 'text',
'value' => null,
], 

[
'label' => 'Phone 2 - Value',
'format' => 'text',
'value' => null,
], 
[
'label' => 'Phone 3 - Type',
'format' => 'text',
'value' => null,
], 
[
'label' => 'Phone 3 - Value',
'format' => 'text',
'value' => null,
], 
[
'label' => 'Phone 4 - Type',
'format' => 'text',
'value' => null,
], 
[
'label' => 'Phone 4 - Value',
'format' => 'text',
'value' => null,
], 
[
'label' => 'Website 1 - Type',
'format' => 'text',
'value' => null,
], 
[
'label' => 'Website 1 - Value',
'format' => 'text',
'value' => null,
],

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