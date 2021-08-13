<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Stagiaire]].
 *
 * @see Stagiaire
 */
class StagiaireQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Stagiaire[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Stagiaire|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
