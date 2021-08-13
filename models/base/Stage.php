<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "stage".
 *
 * @property integer $id
 * @property string $nom
 * @property string $date_debut_du_stage
 * @property string $date_fin_du_stage
 * @property string $theme_id
 *
 * @property \app\models\Stagiaire[] $stagiaires
 */
class Stage extends \yii\db\ActiveRecord
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
            'stagiaires'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nom', 'date_debut_du_stage', 'date_fin_du_stage', 'theme_id'], 'required'],
            [['date_debut_du_stage', 'date_fin_du_stage'], 'safe'],
            [['nom'], 'string', 'max' => 255],
            [['theme_id'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stage';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nom' => Yii::t('app', 'Nom'),
            'date_debut_du_stage' => Yii::t('app', 'Date Debut Du Stage'),
            'date_fin_du_stage' => Yii::t('app', 'Date Fin Du Stage'),
            'theme_id' => Yii::t('app', 'Theme ID'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStagiaires()
    {
        return $this->hasMany(\app\models\Stagiaire::className(), ['id_stage' => 'id']);
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
     * @return \app\models\StageQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \app\models\StageQuery(get_called_class());
        return $query->where([]);
    }
}
