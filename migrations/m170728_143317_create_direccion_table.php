<?php

use yii\db\Migration;

/**
 * Handles the creation of table `direccion_habitacional`.
 * Has foreign keys to the tables:
 *
 * - `municipio`
 * - `parroquia`
 * - `sector`
 * - `comerciante`
 */
class m170728_143317_create_direccion_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('direccion', [
            'id' => $this->primaryKey()->notNull(),
            'municipio_id' => $this->integer(1)->notNull(),
            'parroquia_id' => $this->integer(1)->notNull(),
            'sector_id' => $this->integer()->notNull(),
            'direccion'=> $this->string()->notNull(),
            'tipo'=>$this->string(12)->notNull(),
            'comerciante_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `municipio_id`
        $this->createIndex(
            'idx-direccion-municipio_id',
            'direccion',
            'municipio_id'
        );

        // add foreign key for table `municipio`
        $this->addForeignKey(
            'fk-direccion-municipio_id',
            'direccion',
            'municipio_id',
            'municipio',
            'id',
            'CASCADE'
        );

        // creates index for column `parroquia_id`
        $this->createIndex(
            'idx-direccion-parroquia_id',
            'direccion',
            'parroquia_id'
        );

        // add foreign key for table `parroquia`
        $this->addForeignKey(
            'fk-direccion-parroquia_id',
            'direccion',
            'parroquia_id',
            'parroquia',
            'id',
            'CASCADE'
        );

        // creates index for column `sector_id`
        $this->createIndex(
            'idx-direccion-sector_id',
            'direccion',
            'sector_id'
        );

        // add foreign key for table `sector`
        $this->addForeignKey(
            'fk-direccion-sector_id',
            'direccion',
            'sector_id',
            'sector',
            'id',
            'CASCADE'
        );

        // creates index for column `comerciante_id`
        $this->createIndex(
            'idx-direccion-comerciante_id',
            'direccion',
            'comerciante_id'
        );

        // add foreign key for table `comerciante`
        $this->addForeignKey(
            'fk-direccion-comerciante_id',
            'direccion',
            'comerciante_id',
            'comerciante',
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
            'fk-direccion-municipio_id',
            'direccion'
        );

        // drops index for column `municipio_id`
        $this->dropIndex(
            'idx-direccion-municipio_id',
            'direccion'
        );

        // drops foreign key for table `parroquia`
        $this->dropForeignKey(
            'fk-direccion-parroquia_id',
            'direccion'
        );

        // drops index for column `parroquia_id`
        $this->dropIndex(
            'idx-direccion-parroquia_id',
            'direccion'
        );

        // drops foreign key for table `sector`
        $this->dropForeignKey(
            'fk-direccion-sector_id',
            'direccion'
        );

        // drops index for column `sector_id`
        $this->dropIndex(
            'idx-direccion-sector_id',
            'direccion'
        );

        // drops foreign key for table `comerciante`
        $this->dropForeignKey(
            'fk-direccion-comerciante_id',
            'direccion'
        );

        // drops index for column `comerciante_id`
        $this->dropIndex(
            'idx-direccion-comerciante_id',
            'direccion'
        );

        $this->dropTable('direccion');
    }
}
