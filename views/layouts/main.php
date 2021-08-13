<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\User;


$user=new User();

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <?php $this->registerCsrfMetaTags() ?>
    <title></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
        NavBar::begin([
            //'brandLabel' => Yii::$app->name,
           // 'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                // ['label' => 'Home', 'url' => ['/user/security/login']],
                // ['label' => 'About', 'url' => ['/site/about']],
                // ['label' => 'Contact', 'url' => ['/site/contact']],
                ['label' => Yii::t('app', 'Administrateur'), 'url' => ['/user/admin'], 'visible' => $user->isAdmin()],
                ['label' => Yii::t('app', 'Gérer stagiaires'), 'url' => ['/stagiaire/index'], 'visible' => $user->isAdmin()],
                ['label' => Yii::t('app', 'Gérer stage'), 'url' => ['/stage/index'], 'visible' => $user->isAdmin()],
                ['label' => Yii::t('app', 'Gérer centre d\'etude '), 'url' => ['/centre-detude/index'], 'visible' => $user->isAdmin()],
                ['label' => Yii::t('app', 'Gérer encadreur '), 'url' => ['/encadreur/index'], 'visible' => $user->isAdmin()],
                ['label' => Yii::t('app', 'Gérer departement '), 'url' => ['/encadreur/index'], 'visible' => $user->isAdmin()],
                ['label' => Yii::t('app', 'Gérer Theme '), 'url' => ['/encadreur/index'], 'visible' => $user->isAdmin()],
                
             //   ['label' => Yii::t('app', 'Disbursements'), 'url' => ['/decaissement'], 'visible' => $user->isAdmin()],
               // ['label' => 'Reporting', 'url' => ['/reporting/index'], 'visible' => User::isAdmin()],
              
              
              
                Yii::$app->user->isGuest ? (['label' => 'Login', 'url' => ['/user/security/login']]) : ('<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>')
            ],
        ]);


        NavBar::end();
        ?>

        <div class="container">

            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
      

    
         
           
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy;  <?= date('Y') ?></p>

            <p class="pull-right"></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>