<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[CentreDetude]].
 *
 * @see CentreDetude
 */
class CentreDetudeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CentreDetude[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CentreDetude|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
