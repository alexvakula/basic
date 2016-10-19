<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 *
 * @property Category $parent
 * @property Category[] $categories

 */
class Category extends ActiveRecord
{
    public $executors_count;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'parent_id' => 'Parent',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['parent_id' => 'id']);
    }

    public function getSelCatID()
    {
        return $this->hasMany(SelCatId::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecutors()
    {
        return $this->hasMany(Executor::className(), ['id' => 'executor_id'])->viaTable('{{%sel_cat_id}}', ['category_id' => 'id']);
    }

 public function getStructure()

 {

  //запрос к базе данных в $result попадают все записи из таблицы в виде массива

  $result = Category::find()->asArray()->all();

  //

  if (!$result) {

   return NULL;

  }

  // $arr_cat будет создаваться массив категорий, где индексы, это parent_id

  $arr_cat = array();



  //В цикле формируем массив

  for ($i = 0; $i < count($result);$i++) {

   $row = $result[$i];

   if ($row['parent_id'] == NULL)

   $row['parent_id'] = 0;

   //Формируем массив, где ключами являются id родительской категории

   if (empty($arr_cat[$row['parent_id']])) {

    $arr_cat[$row['parent_id']] = array();

   }

   $arr_cat[$row['parent_id']][] = $row;

  }



// $view_cat - лямда функция для создания массива категорий, который будет передан в отображение

  $view_cat =

  function ($data, $parent_id = 0) use ( & $view_cat)

  {

   $result = NULL;

   if (empty($data[$parent_id])) {

    return;

   }

   $result = array();



   //перебираем в цикле массив и выводим на экран

   for ($i = 0; $i < count($data[$parent_id]);$i++) {

    $result[] = ['label' => $data[$parent_id][$i]['name'],

     'url' => 'assortiment/'.$data[$parent_id][$i]['id'],

      //можно пометить какой либо пункт как активный     

     'active' => $data[$parent_id][$i]['id'] == 8,

     'options' => ['class' => 'dropdown' ],

     'items' => $view_cat($data,$data[$parent_id][$i]['id'])];
  
    //рекурсия - проверяем нет ли дочерних категорий

   }

   return $result;

  };

  $result = $view_cat($arr_cat);

  return $result;

 }

}
