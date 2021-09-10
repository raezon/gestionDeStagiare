<?php

/*
 * Service Responsible On the creation Of the Grade
 *
 *@author ammar djebabla <amardjebabla10@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace app\service;

use app\models\User;
use Yii;

class RegistrationUserRedirectionService
{

    protected $_grade;
    protected $_userId;
    protected $_role;

    /**
     * GradeService constructor.
     *
     *
     */
    public function __construct($role)
    {

        $this->role = $role;
    }

    /**
     * @return bool
     */
    public function run()
    {
        $session = Yii::$app->session;
        $session->remove('role');
        $user = Yii::$app->user->identity;

        switch ($user) {

            case $user->isAdmin():

                return Yii::$app->response->redirect(['/user/admin/index/']);
                break;

            case $user->isApprobateur():

                return Yii::$app->response->redirect(['/decaissement/index/']);
                break;

            case $user->isFinancier():

                return Yii::$app->response->redirect(['/decaissement/index/']);

                break;
            case $user->isUtilisateur():

                return Yii::$app->response->redirect(['/decaissement/create/']);

                break;
        }
    }
}
