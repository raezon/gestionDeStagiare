<?php

namespace app\models;

use Yii;
use \app\models\base\Theme as BaseTheme;

/**
 * This is the model class for table "theme".
 */
class Theme extends BaseTheme
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['date_depot', 'type', 'version'], 'required'],
            [['date_depot'], 'safe'],
            [['type', 'version'], 'string', 'max' => 255]
        ]);
    }
	
}
