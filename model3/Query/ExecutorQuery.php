<?php

namespace app\models\query;

use app\models\ExecutorTag;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\app\models\Executor]].
 *
 * @see \app\models\Executor
 */
class ExecutorQuery extends ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['active' => true]);
    }



    /**
     * @param integer $id
     * @return self
     */
    public function forTag($id)
    {
        return $this->joinWith(['executorTags'], false)->andWhere([ExecutorTag::tableName() . '.tag_id' => $id]);
    }

    /**
     * @param integer $id
     * @return self
     */
    public function forCategory($id)
    {
        return $this->joinWith(['selCatId'], false)->andWhere([SelCatId::tableName() . '.category_id' => $id]);
    }

    /**
     * @inheritdoc
     * @return \app\models\Executor[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Executor|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
