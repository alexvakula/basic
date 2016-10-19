<?php

namespace app\models;

use app\models\query\ExecutorQuery;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
use yii\base\Model;
use yii\web\UploadedFile;
use creocoder\nestedsets\NestedSetsQueryBehavior;

/**
 * This is the model class for table "{{%executor}}".
 *
 * @property integer $id
 * @property integer $city_id
 * @property string $name
 * @property string $content
 * @property integer $price
 * @property integer $active
 *
 * @property Category[] $category
 * @property City[] $city
 * @property ExecutorTag[] $executorTags
 * @property Tag[] $tags
 * @property Value[] $values
 * @property SelCatId[] $selcatid
 * @property Attribute[] $executorAttributes
 */
class Executor extends ActiveRecord
{
 
    /**
     * @var UploadedFile[]
     */
    public $imageFile;


    /**
     * @inheritdoc
     */
    

    public static function tableName()
    {
        return '{{%executor}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rate', 'active', 'blacklist', 'city_id'], 'integer'],
            [['name', 'address', 'tel'], 'required'],
            [['content', 'address', 'tel', 'pasnum', 'paskim', 'note'], 'string'],
            [['pasdate', 'datebirth'], 'string'],
            [['tagsArray'], safe],
     //        [['imageFile'], 'safe'],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, JPG, gif'],
            [['categoriesArray'], safe],
	[['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
        
            [['name'], 'string', 'max' => 255],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            	'id' => '№',
    //        'categoriesArray' => 'Категорія',
            	'name' => 'Ім\'я',
            	'city_id' => 'Населений пункт',
		'address' => 'Адреса',
		'tel' => 'Телефон',
		'pasnum' => 'Серія та номер паспорту',
		'paskim' => 'Ким виданий',
		'pasdate' => 'Дата вид.',
		'datebirth' => 'Дата народження',
            	'note' => 'Примітка',
            	'rate' => 'Рейт',
            	'active' => 'Акт',
            	'imageFile' => 'Фото виконавця',
            	'tagsArray' => 'Tags',
            	'categoriesArray' => 'Категорії',
        ];
    }

   public function calculate_age($birthday) {
	  $birthday_timestamp = strtotime($birthday);
	  $age = date('Y') - date('Y', $birthday_timestamp);
		  if (date('md', $birthday_timestamp) > date('md')) {
 			   $age--;
		  }
 	return $age;
}
 
   /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecutorTags()
    {
        return $this->hasMany(ExecutorTag::className(), ['executor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->viaTable('{{%executor_tag}}', ['executor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSelCatId()
    {
        return $this->hasMany(SelCatId::className(), ['executor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('{{%sel_cat_id}}', ['executor_id' => 'id']);
    }

       /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('{{%sel_cat_id}}', ['executor_id' => 'id']);
    }

       /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValues()
    {
        return $this->hasMany(Value::className(), ['executor_id' => 'id']);
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecutorAttributes()
    {
        return $this->hasMany(Attribute::className(), ['id' => 'attribute_id'])->viaTable('{{%value}}', ['executor_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ExecutorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ExecutorQuery(get_called_class());
    }

    private $_tagsArray;

    public function getTagsArray()
    {
        if ($this->_tagsArray === null) {
            $this->_tagsArray = $this->getTags()->select('id')->column();
        }
        return $this->_tagsArray;
    }

    public function setTagsArray($value)
    {
        $this->_tagsArray = (array)$value;
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->updateTags();
        $this->updateCategories();
        parent::afterSave($insert, $changedAttributes);

//        parent::afterSave($insert, $changedAttributes);

    }


   

    private function updateTags()
    {
        $currentTagIds = $this->getTags()->select('id')->column();
        $newTagIds = $this->getTagsArray();

        foreach (array_filter(array_diff($newTagIds, $currentTagIds)) as $tagId) {
            /** @var Tag $tag */
            if ($tag = Tag::findOne($tagId)) {
                $this->link('tags', $tag);
            }
        }

        foreach (array_filter(array_diff($currentTagIds, $newTagIds)) as $tagId) {
            /** @var Tag $tag */
            if ($tag = Tag::findOne($tagId)) {
                $this->unlink('tags', $tag, true);
            }
        }
    }

    private $_categoriesArray;

    public function getCategoriesArray()
    {
        if ($this->_categoriesArray === null) {
            $this->_categoriesArray = $this->getCategories()->select('id')->column();
        }
        return $this->_categoriesArray;
    }

    public function setCategoriesArray($value)
    {
        $this->_categoriesArray = (array)$value;
    }


    private function updateCategories()
    {
        $currentCategoryIds = $this->getCategories()->select('id')->column();
        $newCategoryIds = $this->getCategoriesArray();

        foreach (array_filter(array_diff($newCategoryIds, $currentCategoryIds)) as $categoryId) {
            /** @var Category $category */
            if ($category = Category::findOne($categoryId)) {
                $this->link('categories', $category);
            }
        }

        foreach (array_filter(array_diff($currentCategoryIds, $newCategoryIds)) as $categoryId) {
            /** @var Category $category */
            if ($category = Category::findOne($categoryId)) {
                $this->unlink('categories', $category, true);
            }
        }
    }

function get_cat() {
	//запрос к базе данных
	$sql = "SELECT * FROM category";
	$result = mysql_query($sql);
	if(!$result) {
		return NULL;
	}
	$arr_cat = $this->_categoriesArray = $this->getCategories()->select('id')->column();
	if(mysql_num_rows($result) != 0) {

		//В цикле формируем массив
		for($i = 0; $i < mysql_num_rows($result);$i++) {
			$row = mysql_fetch_array($result,MYSQL_ASSOC);

			//Формируем массив, где ключами являются адишники на родительские категории
			if(empty($arr_cat[$row['parent_id']])) {
				$arr_cat[$row['parent_id']] = array();
			}
			$arr_cat[$row['parent_id']][] = $row;
		}
		//возвращаем массив
		return $arr_cat;
	}
}
//вывод каталога с помощью рекурсии
function view_cat($arr,$parent_id = 0) {

        if ($this->_categoriesArray === null) {
            $this->_categoriesArray = $this->getCategories()->select('id')->column();
        }
        return $this->_categoriesArray;

	//Условия выхода из рекурсии
	if(empty($this->_categoriesArray[$parent_id])) {
		return;
	}
	echo '<ul>';
	//перебираем в цикле массив и выводим на экран
	for($i = 0; $i < count($this->_categoriesArray[$parent_id]);$i++) {
		echo '<li><a href="?category_id='.$this->_categoriesArray[$parent_id][$i]['id'].
					'&parent_id='.$parent_id.'">'
					.$this->_categoriesArray[$parent_id][$i]['name'].'</a>';
		//рекурсия - проверяем нет ли дочерних категорий
		view_cat($this->_categoriesArray,$this->_categoriesArray[$parent_id][$i]['id']);
		echo '</li>';
	}
	echo '</ul>';

}
     
}
