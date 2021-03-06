<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
use yii\base\Model;
use yii\web\UploadedFile;
use creocoder\nestedsets\NestedSetsQueryBehavior;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property integer $id
 * @property integer $executor_id
 * @property integer $customer_id
 * @property integer $category_id
 * @property string $task
 * @property integer $score
 * @property string $feedback
 * @property string $photo_before
 * @property string $photo_after
 * @property integer $created_at
 * @property integer $updated_at

 *
 * @property Customer[] $customer
 * @property Executor[] $executor
 * @property Category[] $category
 * @property SelCatId[] $selcatid
 */
class Order extends ActiveRecord
{


    /**
     * @var UploadedFile[]
     */
    public $imageFile1;
    public $imageFile2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    public function behaviors() {
        return [
            \yii\behaviors\TimeStampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['executor_id', 'customer_id',  'category_id', 'score', 'transport', 'tranprice', 'instrument', 'gone', 'done', 'recivedcash', 'suma', 'sumof', 'created_at', 'updated_at', 'sumexec'], 'integer'],
            [['task', 'feedback'], 'string'],                                                                                                                
//            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
//            [['categoriesArray'], safe],
            [['imageFile1'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, gif'],
            [['imageFile2'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, gif'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',

            'executor_id' => 'Виконавець',
            'customer_id' => 'Замовник',
//            'category_id' => 'Категорія',
            'task' => 'Завдання',
            'transport' => 'Транспорт',
            'tranprice' => 'Ціна транспорту',
            'instrument' => 'Потрібен інструмент?',
            'gone' => 'Виїхав фахівець',
            'done' => 'Робота завершена',
            'recivedcash' => 'Готівка отримана',
            'score' => 'Рейтинг',
            'feedback' => 'Відгук',
            'imageFile1' => 'Фото до',
            'imageFile2' => 'Фото після',
	    'suma' => 'Сума',
	    'sumexec' => 'Частка виконавця',
	    'sumaof' => 'Комісія офісу',
            	'categoriesArray' => 'Категорії',
            	'category_id' => 'Категорія',
            'created_at' => Yii::t('app', 'Створено'),
            'updated_at' => Yii::t('app', 'Відредаговано'),
		
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

       /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecutor()
    {
        return $this->hasOne(Executor::className(), ['id' => 'executor_id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\Query\OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\Query\OrderQuery(get_called_class());
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSelCatId()
    {
        return $this->hasMany(SelCatId::className(), ['executor_id' => 'id']);
    }


}
