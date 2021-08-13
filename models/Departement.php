<?php

namespace app\models;

use Yii;
use \app\models\base\Departement as BaseDepartement;

/**
 * This is the model class for table "departement".
 */
class Departement extends BaseDepartement
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['name_D', 'short_name'], 'required'],
            [['name_D'], 'string', 'max' => 255],
            [['short_name'], 'string', 'max' => 7],
            [['name_D'], 'unique'],
            [['short_name'], 'unique']
        ]);
    }
	
}
