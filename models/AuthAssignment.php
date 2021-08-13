<?php

namespace app\models;

use Yii;
use \app\models\base\AuthAssignment as BaseAuthAssignment;

/**
 * This is the model class for table "auth_assignment".
 */
class AuthAssignment extends BaseAuthAssignment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(
            parent::rules(),
            [
                [['item_name', 'user_id'], 'required'],
                [['created_at'], 'integer'],
                [['item_name', 'user_id'], 'string', 'max' => 64]
            ]
        );
    }

    /**
     *
     * @inheritdoc
     * @return \app\models\AuthAssignment with a certain user_id
     */
    public static function findAuthAssignment($id)
    {
        return AuthAssignment::find()->where(['user_id' => $id])->one();
    }
}
