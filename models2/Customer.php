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
            [['name', 'address', 'tel'], 'required'],
            [['name', 'address', 'tel'], 'string'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['id' => 'customer_id']],
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
            'address' => 'Address',
            'tel' => 'Tel',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Order::className(), ['customer_id' => 'id']);
    }
}
