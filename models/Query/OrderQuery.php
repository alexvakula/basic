<?php

namespace app\models\query;
use app\models\Category;

/**
 * This is the ActiveQuery class for [[\app\models\Order]].
 *
 * @see \app\models\Order
 */
class OrderQuery extends \yii\db\ActiveQuery
{
   public function active()
    {
        return $this->andWhere(['active' => true]);
    }

    /**
     * @param integer $id
     * @return self
     */
    public function forCategory($id)
    {
        $ids = [$id];
        $childrenIds = [$id];
        while ($childrenIds = Category::find()->select('id')->andWhere(['parent_id' => $childrenIds])->column()) {
            $ids = array_merge($ids, $childrenIds);
        }
        return $this->andWhere(['category_id' => array_unique($ids)]);
    }

    public function forExecutor($id)
    {
        $ids = [$id];
        $childrenIds = [$id];
        while ($childrenIds = Executor::find()->select('id')->column()) {
            $ids = array_merge($ids, $childrenIds);
        }
        return $this->andWhere(['executor_id' => array_unique($ids)]);
    }

    /**
     * @inheritdoc
     * @return \app\models\Order[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Order|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
