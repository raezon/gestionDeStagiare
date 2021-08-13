<?php

/**
 * @author ammar <amardjebabla10@gmail.com>
 * In this Controller we will enhance the creation of role
 */

namespace app\controllers\user;

use Yii;
use Da\User\Filter\AccessRuleFilter;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Da\User\Model\AbstractAuthItem;
use Da\User\Controller\RoleController as BaseController;
use app\models\AuthItem;
use app\models\User;

class RoleController extends BaseController
{
    protected $userId;

    public $user;

    public function init()
    {
        $this->userId = User::getCurrentUser()->id;
        $this->user = new User();
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
    public function actionCreate()
    {
        /** @var AbstractAuthItem $model */
        $model = $this->make($this->getModelClass(), [], ['scenario' => 'create']);
        $authItem = new AuthItem();


        if ($model->load(Yii::$app->request->post())) {
            //Think to use a reposotory
            $authItem->name = $model->name;
            $authItem->description = $model->description;
            $authItem->type = 1;
            if ($authItem->save()) {
                Yii::$app->session->setFlash('success', 'Role a éte crée avec success.');
                return $this->render(
                    'create',
                    [
                        'model' => $model,
                        'unassignedItems' => $this->authHelper->getUnassignedItems($model),
                        'user'=> $this->user
                    ]
                );
            } else {
                return $this->render(
                    'create',
                    [
                        'model' => $authItem->errors,
                        'unassignedItems' => $this->authHelper->getUnassignedItems($model),
                        'user'=> $this->user
                    ]
                );
            };
        }
    }
}
