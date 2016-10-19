<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%customer}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $tel
 *
 * @property Order $id0
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'city_id','address', 'tel'], 'required'],
            [['name', 'address', 'tel', 'note'], 'string'],
            [['rate', 'city_id'], 'integer'],
     //       [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['id' => 'customer_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ПІБ',
            'address' => 'Адреса',
            'tel' => 'Телефон',
            'note' => 'Примітка',
            'rate' => 'Рейтинг',
		'city_id' => 'Нас.пункт',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Order::className(), ['customer_id' => 'id']);
    }
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }


}

