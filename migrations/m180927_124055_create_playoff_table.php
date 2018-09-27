<?php

use yii\db\Migration;

/**
 * Handles the creation of table `playoff`.
 */
class m180927_124055_create_playoff_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('playoff', [
            'id' => $this->primaryKey(),
            'label' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('playoff');
    }
}
