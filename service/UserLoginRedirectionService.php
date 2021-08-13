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

use app\models\User;
use app\models\Grade;


class UserLoginRedirectionService
{

    protected $grade;
    protected $userId;
    protected $role;
    protected $user;


    /**
     * GradeService constructor.
     *
     *                   
     */
    public function __construct()
    {


        $this->user = new User();
        $this->userId=User::getCurrentUser();

    }




    /**
     * @return bool
     */
    public function run()
    {
     
     ;
        if ($this->user->isAdmin()) {
         
            return Yii::$app->response->redirect(['/user/admin/index']);
        } else {
            if ($this->user->isApprobateur()) {
               
                $model = Grade::find()->where(['user_id' => $this->userId->id])->one();
            
                if ($model) {
                  
                    return Yii::$app->response->redirect(['/decaissement/index']);
                } else {
                    
                    Yii::$app->user->logout();
                    Yii::$app->session->setFlash('danger', 'Vous n\'aver pas eu un grade attender que l\'admin vous attribue un grade');
                    
                    return Yii::$app->response->redirect(['/user/security/login']);
                }
            } else {
                if ($this->user->isUtilisateur()) {

                    return Yii::$app->response->redirect(['/decaissement/create']);
                }
            }
        }
    }
}
