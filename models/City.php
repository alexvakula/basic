<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "city".
 *
 * @property integer $id
 * @property string $name
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 250],
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
     * @inheritdoc
     * @return \app\models\Query\CityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\Query\CityQuery(get_called_class());
    }

	    public function getExecutors()
    {
        return $this->hasMany(Executor::className(), ['category_id' => 'id']);
    }

}
