<?php

use yii\db\Migration;

/**
 * Handles the creation of table `score`.
 */
class m180927_133444_create_score_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('score', [
            'id' => $this->primaryKey(),
            'first_team_score' => $this->tinyInteger()->notNull(),
            'second_team_score' => $this->tinyInteger()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('score');
    }
}
