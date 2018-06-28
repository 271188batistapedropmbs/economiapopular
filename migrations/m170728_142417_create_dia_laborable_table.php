<?php

use yii\db\Migration;

/**
 * Handles the creation of table `dia_laboreble`.
 * Has foreign keys to the tables:
 *
 * - `comerciante`
 */
class m170728_142417_create_dia_laborable_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('dia_laborable', [
            'id' => $this->primaryKey()->notNull(),
            'lunes' => $this->integer(1)->notNull(),
            'martes' => $this->integer(1)->notNull(),
            'miercoles' => $this->integer(1)->notNull(),
            'jueves' => $this->integer(1)->notNull(),
            'viernes' => $this->integer(1)->notNull(),
            'sabado' => $this->integer(1)->notNull(),
            'domingo' => $this->integer(1)->notNull(),
            'comerciante_id' => $this->integer(),
        ]);

        // creates index for column `comerciante_id`
        $this->createIndex(
            'idx-dia_laborable-comerciante_id',
            'dia_laborable',
            'comerciante_id'
        );

        // add foreign key for table `comerciante`
        $this->addForeignKey(
            'fk-dia_laborable-comerciante_id',
            'dia_laborable',
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
        // drops foreign key for table `comerciante`
        $this->dropForeignKey(
            'fk-dia_laborable-comerciante_id',
            'dia_laborable'
        );

        // drops index for column `comerciante_id`
        $this->dropIndex(
            'idx-dia_laborable-comerciante_id',
            'dia_laborable'
        );

        $this->dropTable('dia_laborable');
    }
}
