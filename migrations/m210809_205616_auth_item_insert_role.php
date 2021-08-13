<?php

use yii\db\Migration;

/**
 * Class m210809_205616_auth_item_insert_role
 */
class m210809_205616_auth_item_insert_role extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('auth_item', [
            'name' => 'Administrateur',
            'type' => '1',
        ]);
        $this->insert('auth_item', [
            'name' => 'Responsable',
            'type' => '1',
        ]);
        $this->insert('auth_item', [
            'name' => 'Employé',
            'type' => '1',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('auth_item', [
         
        ]);
    }
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210809_205616_auth_item_insert_role cannot be reverted.\n";

        return false;
    }
    */
}
