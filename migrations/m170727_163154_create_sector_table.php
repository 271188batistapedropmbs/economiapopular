<?php

use yii\db\Migration;

/**
 * Handles the creation of table `sector`.
 * Has foreign keys to the tables:
 *
 * - `municipio`
 * - `parroquia`
 */
class m170727_163154_create_sector_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('sector', [
            'id' => $this->primaryKey()->notNull(),
            'municipio_id' => $this->integer(1)->notNull(),
            'parroquia_id' => $this->integer(1)->notNull(),
            'sector' => $this->string(70)->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at'=> $this->dateTime()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
        ]);

        // creates index for column `municipio_id`
        $this->createIndex(
            'idx-sector-municipio_id',
            'sector',
            'municipio_id'
        );

        // add foreign key for table `municipio`
        $this->addForeignKey(
            'fk-sector-municipio_id',
            'sector',
            'municipio_id',
            'municipio',
            'id',
            'CASCADE'
        );

        // creates index for column `parroquia_id`
        $this->createIndex(
            'idx-sector-parroquia_id',
            'sector',
            'parroquia_id'
        );

        // add foreign key for table `parroquia`
        $this->addForeignKey(
            'fk-sector-parroquia_id',
            'sector',
            'parroquia_id',
            'parroquia',
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
            'fk-sector-municipio_id',
            'sector'
        );

        // drops index for column `municipio_id`
        $this->dropIndex(
            'idx-sector-municipio_id',
            'sector'
        );

        // drops foreign key for table `parroquia`
        $this->dropForeignKey(
            'fk-sector-parroquia_id',
            'sector'
        );

        // drops index for column `parroquia_id`
        $this->dropIndex(
            'idx-sector-parroquia_id',
            'sector'
        );

        $this->dropTable('sector');
    }
}
