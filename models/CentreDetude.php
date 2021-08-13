<?php

namespace app\models;

use Yii;
use \app\models\base\CentreDetude as BaseCentreDetude;

/**
 * This is the model class for table "centre_detude".
 */
class CentreDetude extends BaseCentreDetude
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['short_name', 'name', 'type'], 'required'],
            [['short_name'], 'string', 'max' => 8],
            [['name'], 'string', 'max' => 100],
            [['type'], 'string', 'max' => 255],
            [['short_name'], 'unique'],
            [['name'], 'unique']
        ]);
    }
	
}
