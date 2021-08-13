<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "stagiaire".
 *
 * @property string $id
 * @property string $nom
 * @property string $prenom
 * @property string $age
 * @property string $niveaux
 * @property string $email
 * @property string $numr_telephone
 * @property string $adress
 * @property string $specialite
 * @property integer $id_encadreur
 * @property integer $id_stage
 * @property integer $id_centre_etude
 *
 * @property \app\models\Encadreur $encadreur
 * @property \app\models\Stage $stage
 * @property \app\models\CentreDEtude $centreEtude
 */
class Stagiaire extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    private $_rt_softdelete;
    private $_rt_softrestore;

    public function __construct(){
        parent::__construct();

    }

    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'encadreur',
            'stage',
            'centreEtude'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'nom', 'prenom', 'age', 'niveaux', 'email', 'numr_telephone', 'adress', 'specialite', 'id_encadreur', 'id_stage', 'id_centre_etude'], 'required'],
            [['id_encadreur', 'id_stage', 'id_centre_etude'], 'integer'],
            [['id'], 'string', 'max' => 1],
            [['nom', 'prenom', 'niveaux', 'email', 'numr_telephone'], 'string', 'max' => 30],
            [['age'], 'string', 'max' => 3],
            [['adress'], 'string', 'max' => 40],
            [['specialite'], 'string', 'max' => 255],
            [['niveaux'], 'unique'],
            [['email'], 'unique'],
            [['numr_telephone'], 'unique'],
            [['adress'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stagiaire';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nom' => Yii::t('app', 'Nom'),
            'prenom' => Yii::t('app', 'Prenom'),
            'age' => Yii::t('app', 'Age'),
            'niveaux' => Yii::t('app', 'Niveaux'),
            'email' => Yii::t('app', 'Email'),
            'numr_telephone' => Yii::t('app', 'Numr Telephone'),
            'adress' => Yii::t('app', 'Adress'),
            'specialite' => Yii::t('app', 'Specialite'),
            'id_encadreur' => Yii::t('app', 'Id Encadreur'),
            'id_stage' => Yii::t('app', 'Id Stage'),
            'id_centre_etude' => Yii::t('app', 'Id Centre Etude'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEncadreur()
    {
        return $this->hasOne(\app\models\Encadreur::className(), ['id' => 'id_encadreur']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStage()
    {
        return $this->hasOne(\app\models\Stage::className(), ['id' => 'id_stage']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCentreEtude()
    {
        return $this->hasOne(\app\models\CentreDEtude::className(), ['id' => 'id_centre_etude']);
    }
    
    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [

            'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
        ];
    }

    /**
     * The following code shows how to apply a default condition for all queries:
     *
     * ```php
     * class Customer extends ActiveRecord
     * {
     *     public static function find()
     *     {
     *         return parent::find()->where(['deleted' => false]);
     *     }
     * }
     *
     * // Use andWhere()/orWhere() to apply the default condition
     * // SELECT FROM customer WHERE `deleted`=:deleted AND age>30
     * $customers = Customer::find()->andWhere('age>30')->all();
     *
     * // Use where() to ignore the default condition
     * // SELECT FROM customer WHERE age>30
     * $customers = Customer::find()->where('age>30')->all();
     * ```
     */

    /**
     * @inheritdoc
     * @return \app\models\StagiaireQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \app\models\StagiaireQuery(get_called_class());
        return $query->where([]);
    }
}
