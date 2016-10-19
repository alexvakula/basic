<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%executor_tag}}".
 *
 * @property integer $executor_id
 * @property integer $tag_id
 *
 * @property Tag $tag
 * @property Executor $executor
 */
class ExecutorTag extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%executor_tag}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['executor_id', 'tag_id'], 'required'],
            [['executor_id', 'tag_id'], 'integer'],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tag_id' => 'id']],
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
            'tag_id' => 'Tag',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecutor()
    {
        return $this->hasOne(Executor::className(), ['id' => 'executor_id']);
    }
}
