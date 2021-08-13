<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Stage]].
 *
 * @see Stage
 */
class StageQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Stage[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Stage|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
