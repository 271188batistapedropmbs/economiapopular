<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170723_150656_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey()->notNull(),
            'username' => $this->string(45)->notNull()->unique(),
            'password' => $this->string(100)->notNull(),
            'status' => $this->integer(1)->notNull(),
            'type_user' => $this->integer(1)->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
