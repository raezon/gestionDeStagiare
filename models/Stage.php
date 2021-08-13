<?php

namespace app\models;

use Yii;
use \app\models\base\Stage as BaseStage;

/**
 * This is the model class for table "stage".
 */
class Stage extends BaseStage
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['nom', 'date_debut_du_stage', 'date_fin_du_stage', 'theme_id'], 'required'],
            [['date_debut_du_stage', 'date_fin_du_stage'], 'safe'],
            [['nom'], 'string', 'max' => 255],
            [['theme_id'], 'string', 'max' => 30]
        ]);
    }
	
}
