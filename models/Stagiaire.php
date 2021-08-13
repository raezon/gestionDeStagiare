<?php

namespace app\models;

use Yii;
use \app\models\base\Stagiaire as BaseStagiaire;

/**
 * This is the model class for table "stagiaire".
 */
class Stagiaire extends BaseStagiaire
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [[ 'nom', 'prenom', 'age', 'niveaux', 'email', 'numr_telephone', 'adress', 'specialite', 'id_encadreur', 'id_stage', 'id_centre_etude'], 'required'],
            [['id_encadreur', 'id_stage', 'id_centre_etude'], 'integer'],
            [['id'], 'string', 'max' => 1],
            [['nom', 'prenom', 'niveaux', 'email', 'numr_telephone'], 'string', 'max' => 30],
            [['age'], 'string', 'max' => 3],
            [['adress'], 'string', 'max' => 40],
            [['specialite'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['niveaux'], 'unique'],
            [['email'], 'unique'],
            [['numr_telephone'], 'unique'],
            [['adress'], 'unique']
        ]);
    }
	
}
