<?php

require_once __DIR__ .'/../config/bootstrap.php';

use Ka\Tournament\Modules\Common\Constants\PlayOffLabel;
use yii\db\Migration;

/**
 * Class m180929_230129_insert_data_for_playoff_table
 */
class m180929_230129_insert_data_for_playoff_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('playoff', [
            'label' => PlayOffLabel::A1B2
        ]);

        $this->insert('playoff', [
            'label' => PlayOffLabel::A2B1
        ]);

        $this->insert('playoff', [
            'label' => PlayOffLabel::C1D2
        ]);

        $this->insert('playoff', [
            'label' => PlayOffLabel::C2D1
        ]);

        $this->insert('playoff', [
            'label' => PlayOffLabel::E1F2
        ]);

        $this->insert('playoff', [
            'label' => PlayOffLabel::E2F1
        ]);

        $this->insert('playoff', [
            'label' => PlayOffLabel::G1H2
        ]);

        $this->insert('playoff', [
            'label' => PlayOffLabel::G2H1
        ]);

        $this->insert('playoff', [
            'label' => PlayOffLabel::QUARTER_FINAL_ABCD1
        ]);

        $this->insert('playoff', [
            'label' => PlayOffLabel::QUARTER_FINAL_ABCD2
        ]);

        $this->insert('playoff', [
            'label' => PlayOffLabel::QUARTER_FINAL_EFGH1
        ]);

        $this->insert('playoff', [
            'label' => PlayOffLabel::QUARTER_FINAL_EFGH2
        ]);

        $this->insert('playoff', [
            'label' => PlayOffLabel::SEMI_FINAL_1
        ]);

        $this->insert('playoff', [
            'label' => PlayOffLabel::SEMI_FINAL_2
        ]);

        $this->insert('playoff', [
            'label' => PlayOffLabel::FOR_THIRD_PLACE
        ]);

        $this->insert('playoff', [
            'label' => PlayOffLabel::FINAL
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('playoff'); // we can't use truncate method here
    }
}
