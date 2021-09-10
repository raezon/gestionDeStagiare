<?php

/**
 * 
 * 
 */

namespace app\repository;

use app\models\User as User;

class UserRepository
{
   public $userId;

    /*public function __construct($userId)
    {
        $this->userId = $userId;
    }*/


    public function getById($userId)
    {
       return User::find()->where(['id' => $userId])->one();
    }
    //Query Getting By attribute
    public function getId($userId)
    {
        
        return User::find()->where(['id' => $userId])->one()->id;
    }


}
