<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
/**
 * This is the model class for table "sel_cat_id".
 *
 * @property integer $id
 * @property integer $executor_id
 * @property integer $category_id
 *
 * @property Executor $executor
 * @property Category $category
 */
class SelCatId extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sel_cat_id';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['executor_id', 'category_id'], 'required'],
            [['executor_id', 'category_id'], 'integer'],
            [['category_id'], 'unique'],
            [['executor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Executor::className(), 'targetAttribute' => ['executor_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'executor_id' => 'Виконавці',
            'category_id' => 'Категорії',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecutor()
    {
        return $this->hasOne(Executor::className(), ['id' => 'executor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}
