<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%tbl_user}}`.
 */
class m230324_161620_drop_position_column_and_add_position_column_from_the_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $this->dropColumn('tbl_user', 'password');
        $this->addColumn('tbl_user', 'hash_password', $this->string());
        $this->addColumn('tbl_user', 'status', $this->string());
        $this->addColumn('tbl_user', 'auth_key', $this->string());
        $this->addColumn('tbl_user', 'created_at', $this->string());
        $this->addColumn('tbl_user', 'update_at', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function Down()
    {
        $this->addColumn('tbl_user', 'password', $this->string());
        $this->dropColumn('tbl_user', 'hash_password');
        $this->dropColumn('tbl_user', 'status');
        $this->dropColumn('tbl_user', 'auth_key');
        $this->dropColumn('tbl_user', 'created_at');
        $this->dropColumn('tbl_user', 'update_at');
    }
}
