<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "departement".
 *
 * @property integer $id
 * @property string $name_D
 * @property string $short_name
 *
 * @property \app\models\Encadreur[] $encadreurs
 */
class Departement extends \yii\db\ActiveRecord
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
            'encadreurs'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_D', 'short_name'], 'required'],
            [['name_D'], 'string', 'max' => 255],
            [['short_name'], 'string', 'max' => 7],
            [['name_D'], 'unique'],
            [['short_name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departement';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name_D' => Yii::t('app', 'Name D'),
            'short_name' => Yii::t('app', 'short_name'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEncadreurs()
    {
        return $this->hasMany(\app\models\Encadreur::className(), ['id_departement' => 'id']);
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
     * @return \app\models\DepartementQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \app\models\DepartementQuery(get_called_class());
        return $query->where([]);
    }
}
