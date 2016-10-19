<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%tag}}".
 *
 * @property integer $id
 * @property string $name
 *
 * @property ExecutorTag[] $executorTags
 * @property Executor[] $executors
 */
class Tag extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tag}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecutorTags()
    {
        return $this->hasMany(ExecutorTag::className(), ['tag_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecutors()
    {
        return $this->hasMany(Executor::className(), ['id' => 'executor_id'])->viaTable('{{%executor_tag}}', ['tag_id' => 'id']);
    }
}
