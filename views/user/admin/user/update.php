<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Nav;
use yii\helpers\Html;
use app\widgets\Grade;

/**
 * @var yii\web\View        $this
 * @var \Da\User\Model\User $user
 */

$this->title = Yii::t('app', 'Modify user account');
$this->params['breadcrumbs'][] = ['label' => Yii::t('usuario', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="clearfix"></div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
                <?= $this->render('/shared/_menu',['user'=>$user]) ?>
                <div class="row">
                    <div class="col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <?= Nav::widget(
                                    [
                                        'options' => [
                                            'class' => 'nav-pills nav-stacked',
                                        ],
                                        'items' => [
                                            [
                                                'label' => Yii::t('app',   'User modification'),
                                                'url' => ['/user/admin/update'],
                                            ],
                                            /* [
                                                'label' => Yii::t('usuario', 'Profile details'),
                                                'options' => [
                                                    'class' => 'disabled',
                                                    'onclick' => 'return false;',
                                                ],
                                            ],
                                            [
                                                'label' => Yii::t('usuario', 'Information'),
                                                'options' => [
                                                    'class' => 'disabled',
                                                    'onclick' => 'return false;',
                                                ],
                                            ],
                                            */
                                        ],
                                    ]
                                ) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <?php $form = ActiveForm::begin(
                                    [
                                        'layout' => 'horizontal',
                                        'enableAjaxValidation' => false,
                                        'enableClientValidation' => false,
                                        'fieldConfig' => [
                                            'horizontalCssClasses' => [
                                                'wrapper' => 'col-sm-9',
                                            ],
                                        ],
                                    ]
                                ); ?>


                                <?= Yii::$app->controller->make(Grade::class, ['form' => $form, 'user' => $user,'authItem'=> $authItem])->run() ?>
                                <div class="gradeInputs"></div>
                                <div class="form-group">
                                    <div class="col-lg-offset-3 col-lg-9">
                                        <?= Html::submitButton(
                                            Yii::t('usuario', 'Update'),
                                            ['class' => 'btn btn-block btn-success']
                                        ) ?>
                                    </div>
                                </div>

                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>