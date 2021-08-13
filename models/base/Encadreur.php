<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "encadreur".
 *
 * @property integer $id
 * @property string $nom
 * @property string $prenom
 * @property string $id_encadreur
 * @property string $email
 * @property string $statu
 * @property string $numr_telephone
 * @property integer $id_departement
 *
 * @property \app\models\Departement $departement
 * @property \app\models\Stagiaire[] $stagiaires
 */
class Encadreur extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    private $_rt_softdelete;
    private $_rt_softrestore;

    public function __construct(){
        parent::__construct();
     /*   $this->_rt_softdelete = [
            'deleted_by' => \Yii::$app->user->id,
            'deleted_at' => date('Y-m-d H:i:s'),
        ];
        $this->_rt_softrestore = [
            'deleted_by' => 0,
            'deleted_at' => date('Y-m-d H:i:s'),
        ];*/
    }

    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'departement',
            'stagiaires'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nom', 'prenom', 'id_encadreur', 'email', 'statu', 'numr_telephone', 'id_departement'], 'required'],
            [['id_departement'], 'integer'],
            [['nom', 'prenom', 'id_encadreur', 'email', 'statu', 'numr_telephone'], 'string', 'max' => 30],
            [['email'], 'unique'],
            [['numr_telephone'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'encadreur';
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
            'id_encadreur' => Yii::t('app', 'Id Encadreur'),
            'email' => Yii::t('app', 'Email'),
            'statu' => Yii::t('app', 'Statu'),
            'numr_telephone' => Yii::t('app', 'Numr Telephone'),
            'id_departement' => Yii::t('app', 'Id Departement'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartement()
    {
        return $this->hasOne(\app\models\Departement::className(), ['id' => 'id_departement']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStagiaires()
    {
        return $this->hasMany(\app\models\Stagiaire::className(), ['id_encadreur' => 'id']);
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
     * @return \app\models\EncadreurQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \app\models\EncadreurQuery(get_called_class());
        return $query->where([]);
    }
}
