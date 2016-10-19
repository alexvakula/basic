<?php

namespace app\models\Query;

/**
 * This is the ActiveQuery class for [[\app\models\City]].
 *
 * @see \app\models\City
 */
class CityQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\City[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\City|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
