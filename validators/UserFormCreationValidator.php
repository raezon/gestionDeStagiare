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

class UserFormCreationValidator implements ValidatorInterface
{
    protected $user;

    /**
     * UserFormErrorsValidator constructor.
     *
     * @param $user
     * @param $grade

     */
    public function __construct($user)
    {
        $this->user = $user;

    }

    /**
     * @throws InvalidSecretKeyException
     * @return bool|int
     *
     */
    public function validate()
    {
        if ($this->user->load(Yii::$app->request->post())&&$this->user->role == $this->user::ROLE_ADMIN  && $this->user->validate()) {

            return true;
        } else {
            print_r($this->user->errors);
            die();
            return false;
        }
    }
}
