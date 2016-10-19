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

 * @property string $name
 * @property string $content
 * @property integer $price
 * @property integer $active
 *
 * @property Category[] $categories
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
            [['rate', 'active', 'blacklist'], 'integer'],
            [['name'], 'required'],
            [['content', 'address', 'tel', 'pasnum', 'paskim', 'note'], 'string'],
            [['pasdate', 'datebirth'], 'string'],
            [['tagsArray'], 'safe'],
     //        [['imageFile'], 'safe'],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, gif'],
   //         [['categoriesArray'], 'safe'],
            [['name'], 'string', 'max' => 255],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            	'id' => 'Номер',
    //        'categoriesArray' => 'Категорія',
            	'name' => 'Ім\'я',
		'address' => 'Адреса',
		'tel' => 'Телефон',
		'pasnum' => 'Серія та номер паспорту',
		'paskim' => 'Ким виданий',
		'pasdate' => 'Дата вид.',
		'datebirth' => 'Дата народження',
            	'note' => 'Примітка',
            	'rate' => 'Рейтинг',
            	'active' => 'Активний',
            	'imageFile' => 'Фото виконавця',
            	'tagsArray' => 'Tags',
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
    public function getValues()
    {
        return $this->hasMany(Value::className(), ['executor_id' => 'id']);
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


    

     
}
