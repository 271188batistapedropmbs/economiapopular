<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comerciante`.
 * Has foreign keys to the tables:
 *
 * - `rubro`
 */
class m170728_141054_create_comerciante_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
      $this->createTable('comerciante', [
          'id' => $this->primaryKey()->notNull(),
          'nombres_y_apellidos' => $this->string(100)->notNull(),
          'nacionalidad'=>$this->string(1)->notNull(),
          'cedula' => $this->string(9)->notNull(),
          'estado_civil' => $this->string(7)->notNull(),
          'fecha_nacimiento' => $this->date()->notNull(),
          'sexo' => $this->string(9)->notNull(),
          'telefono'=>$this->string(11)->notNull(),
          'correo' => $this->string(100),
          'tipo'=>$this->string(12)->notNull(),
          'estructura'=>$this->string(11)->notNull(),
          'rubro_id' => $this->integer()->notNull(),
          'tiempo' => $this->string(50)->notNull(),
          'created_at' => $this->dateTime()->notNull(),
          'updated_at'=> $this->dateTime()->notNull(),
          'created_by' => $this->integer()->notNull(),
          'updated_by' => $this->integer()->notNull(),
      ]);

        // creates index for column `rubro_id`
        $this->createIndex(
            'idx-comerciante-rubro_id',
            'comerciante',
            'rubro_id'
        );

        // add foreign key for table `rubro`
        $this->addForeignKey(
            'fk-comerciante-rubro_id',
            'comerciante',
            'rubro_id',
            'rubro',
            'id',
            'CASCADE'
        );


    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `rubro`
        $this->dropForeignKey(
            'fk-comerciante-rubro_id',
            'comerciante'
        );

        // drops index for column `rubro_id`
        $this->dropIndex(
            'idx-comerciante-rubro_id',
            'comerciante'
        );

        $this->dropTable('comerciante');
    }
}
