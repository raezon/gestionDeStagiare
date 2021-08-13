<?php

namespace app\models;

use Yii;
use \app\models\base\Encadreur as BaseEncadreur;

/**
 * This is the model class for table "encadreur".
 */
class Encadreur extends BaseEncadreur
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['nom', 'prenom', 'id_encadreur', 'email', 'statu', 'numr_telephone', 'id_departement'], 'required'],
            [['id_departement'], 'integer'],
            [['nom', 'prenom', 'id_encadreur', 'email', 'statu', 'numr_telephone'], 'string', 'max' => 30],
            [['email'], 'unique'],
            [['numr_telephone'], 'unique']
        ]);
    }
	
}
