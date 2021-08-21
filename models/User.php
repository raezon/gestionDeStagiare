<?php

namespace app\models;
use Yii;

use Da\User\Model\User as BaseUser;
use Da\User\Traits\ContainerAwareTrait;
use Da\User\Traits\ModuleAwareTrait;
use Da\User\Helper\SecurityHelper;
use yii\helpers\ArrayHelper;
use app\models\AuthAssignment;
use Da\User\Helper\AuthHelper;
use yii\web\IdentityInterface;
/**
 * User ActiveRecord model.
 *
 * @property string $role
 *
 *
 */

class User extends BaseUser 
{

    const ROLE_ADMIN = 'Administrateur';
    const ROLE_RESPONSABLE= 'Responsable';
    const ROLE_EMPLOYEE = 'Employé';

    public $password_changed_at;
    public $isGuest;
 
    /**
     * {@inheritdoc}
     */
    public $role;

    public function rules()
    {
        $rules = parent::rules();
        return ArrayHelper::merge($rules, [
            [['role'], 'safe'],
            [['password'],'required', 'on' => 'create']
        ]);
    }
    public function getIsGuest(){
        return self::getCurrentUser()->isGuest;
    }
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('usuario', 'Username'),
            'email' => Yii::t('usuario', 'Email'),
            'registration_ip' => Yii::t('usuario', 'Registration IP'),
            'unconfirmed_email' => Yii::t('usuario', 'New email'),
            'password' => Yii::t('usuario', 'Password'),
            'created_at' => Yii::t('usuario', 'Registration time'),
            'confirmed_at' => Yii::t('usuario', 'Confirmation time'),
            'last_login_at' => Yii::t('usuario', 'Last login time'),
            'role'=> Yii::t('app', 'Role')
            
        ];
    }

    public static function tableName()
    {
        return '{{%user}}';
    }



    public static function getCurrentUser()
    {
        return \Yii::$app->user;
    }


    public function hasRole($role)
    {
        $auth = new AuthHelper();
        $userId= \Yii::$app->user->id;
       
        return $auth->hasRole($userId, $role);
    }
    
    /**
     * Methode Get Role Of a user by Id
     *
     * @return string
     */
    public function getRole(){
        return $this->getAuth()->getRole($this->getId());
    }
    /**
     * Methode Check is User is a Guest
     *
     * @return boolean
     */
    public  function isGuest() {
       // return $this->getAuth()->getRole($this->getId());
        return self::getCurrentUser()->isGuest;
    }
    /**
     * Methode Check is User is a Admin
     *
     * @return boolean
     */
    public  function isAdmin( ) {
    
       return  $this->hasRole(self::ROLE_ADMIN);
        
        //return (!self::isGuest() && (self::getCurrentUser()->identity->isAdmin /*|| $this->getRole() == ROLE_ADMIN */));
    }
    /**
     * Methode Check is User is a Approbateur
     *
     * @return boolean
     */
    public  function isResponsable()
    {
        return  $this->hasRole(self::ROLE_RESPONSABLE);
    }
    /**
     * Methode Check is User is a Utilisateur
     *
     * @return boolean
     */
    public   function isEmployee() {
        return  $this->hasRole(self::ROLE_EMPLOYEE);
    }
    /**
     * Methode Assign Role To a specifique User after it's creation By an admin
     *
     * @return boolean
     */
    public function setAuthAssignement($id,$roleName)
    {
        $model = new AuthAssignment();
        $model->item_name = $roleName;
        $model->user_id = $id;
        $time = time();
        $model->created_at =$time;
        if($model->save()){

        }else{
            print_r($model->errors);
            die();
        }
        return $model->save();
    }
    //Queries
    public function findUser($id){

        return User::find()->where(['id' => $id])->one();

    }
    
    public static function createUser($model){
        $time = time();
        $self = new Self();
        $security = $self->make(SecurityHelper::class);
        $model->password_hash= $security->generatePasswordHash($model->password, $self->getModule()->blowfishCost);
        $model->confirmed_at = $time;
        $model->created_at =$time;
        $model->updated_at =$time;
        return $model->save();
    }




}

