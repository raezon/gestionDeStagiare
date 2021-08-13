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

use Yii;

use app\models\AuthAssignment as  AuthAssignment;


class DecaissementRedirectionService
{

    protected $grade;
    protected $userId;
    protected $role;

    /**
     * GradeService constructor.
     *
     *                   
     */
    public function __construct($grade, $userId, $role)
    {
        $this->grade = $grade;
        $this->userId = $userId;
        $this->role = $role;
    }


    /**
     * create grade for an approbateur
     * @return bool
     */
    public function createGrade($grade, $userId)
    {
        //Think how to use for it a reposotory .
        $auth_item = AuthAssignment::find()->where(['user_id' => $userId])->one();
        $grade->auth_assignment_id = $auth_item->id;
        $grade->user_id = $userId;

        if ($grade->save()) {
            \Yii::$app->session->setFlash('success', 'Grade  crée avec success');
            return true;
        } else {
            return false;
     
        }
    }

    /**
     * @return bool
     */
    public function run()
    {
        if ($this->role == Yii::$app->params['roles'][1]) {
            if ($this->createGrade($this->grade, $this->userId)) {
                return true;
            }
        }
        return false;
    }
}
