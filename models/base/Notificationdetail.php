<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;
use app\models\Notifications;

/**
 * This is the base model class for table "notificationdetail".
 *
 * @property integer $id
 * @property string $montant
 * @property integer $decaissement_id
 * @property integer $sender_user_id
 * @property integer $reciever_user_id
 *
 * @property \app\models\User $decaissement
 * @property \app\models\User $recieverUser
 * @property \app\models\User $senderUser
 * @property \app\models\Notifications[] $notifications
 */
class Notificationdetail extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['montant', 'decaissement_id', 'sender_user_id', 'reciever_user_id'], 'required'],
            [['montant'], 'number'],
            [['decaissement_id', 'sender_user_id', ], 'integer']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notificationdetail';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'montant' => 'Montant',
            'decaissement_id' => 'Decaissement ID',
            'sender_user_id' => 'Sender User ID',
            'reciever_user_id' => 'Reciever User ID',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDecaissement()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'decaissement_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecieverUser()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'reciever_user_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSenderUser()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'sender_user_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications()
    {
        return $this->hasMany(Notifications::className(), ['notificationdetail_id' => 'id']);
    }
    
/**
     * @inheritdoc
     * @return array mixed
     */ 
    public function behaviors()
    {
        return [
            
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\NotificationdetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\NotificationdetailQuery(get_called_class());
    }
}
