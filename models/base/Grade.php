<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "grade".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $auth_assignment_id
 * @property string $niveau
 * @property string $montant
 * @property integer $updated_at
 * @property integer $created_at
 *
 * @property \app\models\Role $role
 * @property \app\models\User $user
 */
class Grade extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['niveau', 'montant'], 'required'],
            [['user_id'],'safe'],
            [[ 'updated_at', 'created_at'], 'integer'],
            [['montant'], 'number'],
      //      [['niveau'], 'string', 'max' => 255],
           // [['lock'], 'default', 'value' => '0'],
          //  [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grade';
    }

    /**
     * 
     * @return string
     * overwrite function optimisticLock
     * return string name of field are used to stored optimistic lock 
     * 
     */
    public function optimisticLock() {
        //return 'lock';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Id'),
            'user_id' => Yii::t('app', 'user_id'),
            'auth_assignment_id' => Yii::t('app', 'auth_assignment_id'),
            'niveau' => Yii::t('app', 'niveau'),
            'montant' => Yii::t('app', 'amount'),
        ];
    }
    
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignment()
    {
        return $this->hasOne(\app\models\AuthAssignment::className(), ['id' => 'auth_assignment_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'user_id']);
    }
    
/**
     * @inheritdoc
     * @return array mixed
     */ 
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],

        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\GradeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\GradeQuery(get_called_class());
    }
    /**
     *
     * @inheritdoc
     * @return \app\models\Grade with a certain user_id
     */
    public static function findGrade($id){
       return Grade::find()->where(['user_id' => $id])->one();
    }
}
