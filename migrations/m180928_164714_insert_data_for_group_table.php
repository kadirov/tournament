<?php

use yii\db\Migration;

/**
 * Class m180928_164714_insert_data_for_group_table
 */
class m180928_164714_insert_data_for_group_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('group', [
            'label' => 'A'
        ]);

        $this->insert('group', [
            'label' => 'B'
        ]);

        $this->insert('group', [
            'label' => 'C'
        ]);

        $this->insert('group', [
            'label' => 'D'
        ]);

        $this->insert('group', [
            'label' => 'E'
        ]);

        $this->insert('group', [
            'label' => 'F'
        ]);

        $this->insert('group', [
            'label' => 'G'
        ]);

        $this->insert('group', [
            'label' => 'H'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('group');
    }
}
