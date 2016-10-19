<?php

namespace app\models;

use Yii;
use creocoder\nestedsets\NestedSetsBehavior;
use app\models\query\CategoryQuery;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $tree
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property integer $position
 * @property integer $created_at
 * @property integer $updated_at
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    public function behaviors() {
        return [
            \yii\behaviors\TimeStampBehavior::className(),
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                'treeAttribute' => 'tree',
                // 'leftAttribute' => 'lft',
                // 'rightAttribute' => 'rgt',
                // 'depthAttribute' => 'depth',
            ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['position'], 'default', 'value' => 0],
            [['tree', 'lft', 'rgt', 'depth', 'position', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => Yii::t('app', 'ID'),
            'name'       => Yii::t('app', 'Назва'),
            'tree'       => Yii::t('app', 'Дерево'),
            'lft'        => Yii::t('app', 'Зліва'),
            'rgt'        => Yii::t('app', 'Справа'),
            'depth'      => Yii::t('app', 'Глибина'),
            'position'   => Yii::t('app', 'Позиція'),
            'created_at' => Yii::t('app', 'Створено'),
            'updated_at' => Yii::t('app', 'Відредаговано'),
        ];
    }

    /**
     * Get parent's ID
     * @return \yii\db\ActiveQuery 
     */
    public function getParentId()
    {
        $parent = $this->parent;
        return $parent ? $parent->id : null;
    }

    /**
     * Get parent's node
     * @return \yii\db\ActiveQuery 
     */
    public function getParent()
    {
        return $this->parents(1)->one();
    }

    /**
     * Get a full tree as a list, except the node and its children
     * @param  integer $node_id node's ID
     * @return array array of node
     */
    public static function getTree($node_id = 0)
    {
        // don't include children and the node
        $children = [];

  /*      if (!empty($node_id))
            $children = array_merge(
                self::findOne($node_id)->children()->column(),
                [$node_id]
                );
    */
        $rows = self::find()->
            select('id, name, depth')->
            where(['NOT IN', 'id', $children])->
            orderBy('tree, lft, position')->
            all();

        $return = [];
        foreach ($rows as $row)
            $return[$row->id] = str_repeat(' ---- ', $row->depth) . ' ' . $row->name;
       	 return $return;
    }
   /**

 * Создает массив items для виджетов menu или navbar.

 *

 * @return array например $result =  Array(

 * [0] => Array

 * (

 *        [label] => Одежда

 *        [url] => assortiment/7

 *        [active] =>

 *        [options] => Array

 *            (

 *                [class] => dropdown

 *             )

 *        [items] => Array

 *            (

 *                [0] => Array

 *                    (

 *                        [label] => Носки

 *                        [url] => assortiment/8

 *                        [active] => 1

 *                        [options] => Array

 *                            (

 *                                [class] => dropdown

 *                            )

 *         )

 * [1] => Array

 * (

 *    [label] => Обувь

 *    [url] => assortiment/9

 *    [active] =>

 *     [options] => Array

 *        (

 *            [class] => dropdown

 *        )

 *  )

 * )

 */

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
