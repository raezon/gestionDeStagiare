<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace app\validators;

use Yii;
use Da\TwoFA\Exception\InvalidSecretKeyException;
use Da\TwoFA\Manager;
use Da\User\Contracts\ValidatorInterface;
use Da\User\Model\User;

class UserFormCreationErrorsValidator implements ValidatorInterface
{
    protected $grade;
    protected $user;
    protected $errors;

    /**
     * UserFormErrorsValidator constructor.
     *
     * @param $user
     * @param $grade

     */
    public function __construct($user, $grade)
    {
        $this->user = $user;
        $this->grade = $grade;
    }

    /**
     * @throws InvalidSecretKeyException
     * @return bool|int
     *
     */
    public function validate()
    {
        $session = Yii::$app->session;
        if (($session->get('role') == $this->user::ROLE_APPROVING  and !$this->user->validate()) or
            ($session->get('role') == $this->user::ROLE_APPROVING and  $this->user->validate())
        ) {
            
          //  $session->remove('role');
           

            return true;
        } else {
            if($this->user->validate()){
                return $this->user->errors;
            }
            return false;
        }
    }
}
