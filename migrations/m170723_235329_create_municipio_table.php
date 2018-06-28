<?php

use yii\db\Migration;

/**
 * Handles the creation of table `municipio`.
 */
class m170723_235329_create_municipio_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('municipio', [
            'id' => $this->primaryKey()->notNull(),
            'municipio' => $this->string(50)->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('municipio');
    }
}
