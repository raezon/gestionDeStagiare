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



class RegistrationUserRedirectionService
{

    protected $grade;
    protected $userId;
    protected $role;

    /**
     * GradeService constructor.
     *
     *                   
     */
    public function __construct( $role)
    {

        $this->role = $role;
    }




    /**
     * @return bool
     */
    public function run()
    {
    
        return Yii::$app->response->redirect(['/user/admin/index/']);
       
       
    }
}
