<?php

use yii\db\Migration;

/**
 * Handles the creation of table `parroquia`.
 * Has foreign keys to the tables:
 *
 * - `municipio`
 */
class m170724_115811_create_parroquia_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('parroquia', [
            'id' => $this->primaryKey()->notNull(),
            'parroquia' => $this->string(40)->notNull(),
            'municipio_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at'=> $this->dateTime()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
        ]);

        // creates index for column `municipio_id`
        $this->createIndex(
            'idx-parroquia-municipio_id',
            'parroquia',
            'municipio_id'
        );

        // add foreign key for table `municipio`
        $this->addForeignKey(
            'fk-parroquia-municipio_id',
            'parroquia',
            'municipio_id',
            'municipio',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `municipio`
        $this->dropForeignKey(
            'fk-parroquia-municipio_id',
            'parroquia'
        );

        // drops index for column `municipio_id`
        $this->dropIndex(
            'idx-parroquia-municipio_id',
            'parroquia'
        );

        $this->dropTable('parroquia');
    }
}
