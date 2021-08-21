<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace app\controllers\user;


use Yii;
use yii\base\Module;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\web\Controller;
//models
use app\models\User;
use app\models\AuthAssignment;
use app\models\AuthItem;
//Event
use Da\User\Event\UserEvent;
//Facotry
use Da\User\Factory\MailFactory;
//Filters
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Da\User\Filter\AccessRuleFilter;
//Search
use Da\User\Search\UserSearch;
//Service
use Da\User\service\UserBlockService;
use Da\User\service\UserConfirmationService;
use Da\User\service\UserCreateService;
use app\Service\RegistrationUserRedirectionService;
//Validators
use Da\User\Validator\AjaxRequestModelValidator;
use app\validators\UserFormCreationErrorsValidator;
use app\validators\UserFormCreationValidator;
//Repository




use Da\User\Controller\AdminController as BaseController;;
class AdminController extends BaseController
{

    protected $userId;
    public $user;
    public $authItem;
    public function init()
    {
        $this->userId = User::getCurrentUser()->id;
        $this->user = new User();
        $this->authItem = AuthItem::findAuthItem();
        parent::init();
    }
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                    'confirm' => ['post'],
                    'block' => ['post'],
                    //'switch-identity' => ['post','get'],
                    'password-reset' => ['post'],
                    'force-password-change' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'ruleConfig' => [
                    'class' => AccessRuleFilter::class,
                ],
                'rules' => [

                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return  $this->user->isAdmin();
                        },
                    ],
                ],
            ],
        ];
    }
    public function actionIndex()
    {

        $searchModel = $this->make(UserSearch::class);
        $dataProvider = $searchModel->search(\Yii::$app->request->get());



        return $this->render(
            'user/index',
            [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
                'user' => $this->user
            ]
        );
    }
    public function actionConfirm($id)
    {
        /** @var User $user */
        $user = $this->userQuery->where(['id' => $id])->one();
        /** @var UserEvent $event */
        $event = $this->make(UserEvent::class, [$user]);

        $this->trigger(UserEvent::EVENT_BEFORE_CONFIRMATION, $event);

        if ($this->make(UserConfirmationService::class, [$user])->run()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('usuario', 'User has been confirmed'));
            /**
             * static method for the assignement of responsableDeStation On userConfirmation by an admin
             *@param mixed $user_id
             */
            $this->user->setAuthAssignement($user->id, 'Utilisateur');


            $this->trigger(UserEvent::EVENT_AFTER_CONFIRMATION, $event);
        } else {
            Yii::$app->getSession()->setFlash(
                'warning',
                Yii::t('usuario', 'Unable to confirm user. Please, try again.')
            );
        }

        return $this->redirect(Url::previous('actions-redirect'));
    }


    /**
     * @parms
     */
    public function actionBlock($id)
    {
        if ((int)$id === Yii::$app->user->getId()) {
            Yii::$app->getSession()->setFlash('danger', Yii::t('usuario', 'You cannot remove your own account'));
        } else {
            /** @var User $user */
            $user = $this->userQuery->where(['id' => $id])->one();
            /** @var UserEvent $event */
            $event = $this->make(UserEvent::class, [$user]);

            if ($this->make(UserBlockService::class, [$user, $event, $this])->run()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('usuario', 'User block status has been updated.'));
            } else {
                Yii::$app->getSession()->setFlash('danger', Yii::t('usuario', 'Unable to update block status.'));
            }
        }

        return $this->redirect(Url::previous('actions-redirect'));
    }


    public function actionCreate()
    {
        /** @var User $user */
        $user = new User();
        /** @var Grade $grqde */
        /** @var UserEvent $event */
        $event = $this->make(UserEvent::class, [$user]);

        $this->make(AjaxRequestModelValidator::class, [$user])->validate();

        if ($user->load(Yii::$app->request->post())) {
            // $this->trigger(UserEvent::EVENT_BEFORE_CREATE, $event);


            if ($user->createUser($user)) {
                //Assigning Role
                $this->user->setAuthAssignement($user->id, $user->role);
                //Creation of Flash Message .
                Yii::$app->getSession()->setFlash('success', Yii::t('usuario', 'User has been created'));
                //Redirection For Registered user After the registration .
                $this->make(RegistrationUserRedirectionService::class, [$user->role])->run();
            } else {

                Yii::$app->session->setFlash('danger', Yii::t('usuario', 'User account could not be created.'));
            }
        }


        return $this->render('user/create', ['user' => $user, 'authItem' => $this->authItem]);
    }

    /**
     *  Overide action Update
     *
     * @param [type] $id
     * @return void
     */
    public function actionUpdate($id)
    {

        $user = $this->user->findUser($id);
        /** @var UserEvent $event */
        $event = $this->make(UserEvent::class, [$user]);
        $auth = AuthAssignment::findAuthAssignment($id);

        //Needed in form and form embded for ajax onchange request
        $user->role = $auth->item_name;

        $this->make(AjaxRequestModelValidator::class, [$user])->validate();

        if ($this->make(UserFormCreationValidator::class, [$user])->validate()) {
 
            $this->trigger(ActiveRecord::EVENT_BEFORE_UPDATE, $event);

            if ($user->load(Yii::$app->request->post()) and $user->update()) {
                //Update
                Yii::$app->getSession()->setFlash('success', Yii::t('usuario', 'Account details have been updated'));
                $this->trigger(ActiveRecord::EVENT_AFTER_UPDATE, $event);

                return $this->redirect(['/user/admin/index']);
            }
        }

        return $this->render('user/update', ['user' => $user, 'authItem' => $this->authItem]);
    }
}
