<?php

use yii\db\Migration;

/**
 * Class m230329_144620_add_column_from_user_tables
 */
class m230329_144620_add_column_from_user_tables extends Migration
{


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('tbl_user', 'role', $this->boolean());
    }

    public function down()
    {
        $this->dropColumn('tbl_user', 'role');
    }

}
