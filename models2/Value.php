<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%value}}".
 *
 * @property integer $executor_id
 * @property integer $attribute_id
 * @property string $value
 *
 * @property Attribute $executorAttribute
 * @property Executor $executor
 */
class Value extends ActiveRecord
{
    const SCENARIO_TABULAR = 'tabular';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%value}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['executor_id', 'attribute_id'], 'required'],
            [['value'], 'required', 'except' => self::SCENARIO_TABULAR],
            [['executor_id', 'attribute_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['attribute_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attribute::className(), 'targetAttribute' => ['attribute_id' => 'id']],
            [['executor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Executor::className(), 'targetAttribute' => ['executor_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'executor_id' => 'Executor',
            'attribute_id' => 'Attribute',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecutorAttribute()
    {
        return $this->hasOne(Attribute::className(), ['id' => 'attribute_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecutor()
    {
        return $this->hasOne(Executor::className(), ['id' => 'executor_id']);
    }
}
