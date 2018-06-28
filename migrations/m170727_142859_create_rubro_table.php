<?php

use yii\db\Migration;

/**
 * Handles the creation of table `rubro`.
 */
class m170727_142859_create_rubro_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('rubro', [
            'id' => $this->primaryKey()->notNull(),
            'rubro' => $this->string(70)->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at'=> $this->dateTime()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('rubro');
    }
}
