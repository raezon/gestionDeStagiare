<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * @author ammar djebabka <amardjebabla10@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

?>


<?php Pjax::begin(); ?>

<?= $form->field($user, 'email')->textInput(['placeholder' => 'Entrer l\'email...', 'maxlength' => 255]) ?>
<?= $form->field($user, 'username')->textInput(['placeholder' => 'Entrer le nom d\'utilisateur...', 'maxlength' => 255]) ?>
<?= $form->field($user, 'password')->passwordInput(['placeholder' => 'Entrer un mot de passe...']) ?>
<?= $form->field($user, 'role')->dropDownList(


    ArrayHelper::map($authItem, 'name', 'name'),

    ['prompt' => 'Sélectionner un Role']
);
?>

<?php Pjax::end(); ?>


