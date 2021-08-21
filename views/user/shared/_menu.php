<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use yii\bootstrap\Nav;
use app\models\User;



?>

<?= Nav::widget(
    [
        'options' => [
            'class' => 'nav-tabs',
            'style' => 'margin-bottom: 15px',
        ],
        'items' => [
            [
                'label' => Yii::t('app', 'User'),
                'url' => ['/user/admin/index'],
                'visible' => Yii::$app->user->identity->isAdmin()
            ],
            [
                'label' => Yii::t('app', 'Roles'),
                'url' => ['/user/role/index'],
                'visible' =>  Yii::$app->user->identity->isAdmin()
            ],
        
            [
                'label' => Yii::t('app', 'Create demande'),
                'url' => ['/decaissement/create'],
                'visible' =>  Yii::$app->user->identity->isEmployee()
            ],
            [
                'label' => Yii::t('app', 'My Disbursements'),
                'url' => ['/decaissement/index'],
                'visible' =>  Yii::$app->user->identity->isEmployee()
            ],
            [
                'label' => Yii::t('app', 'Create'),
                'items' => [
                    [
                        'label' => Yii::t('app', 'New user'),
                        'url' => ['/user/admin/create/'],
                    ],
                ]
                , 'visible' =>  Yii::$app->user->identity->isAdmin()
            ],
        ],
    ]
) ?>
