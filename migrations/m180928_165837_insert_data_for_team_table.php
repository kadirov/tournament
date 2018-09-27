<?php

use yii\db\Migration;

/**
 * Class m180928_165837_insert_data_for_team_table
 */
class m180928_165837_insert_data_for_team_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('team', [
            'name' => 'Brazil',
            'power' => 10,
        ]);

        $this->insert('team', [
            'name' => 'Germany',
            'power' => 10,
        ]);

        $this->insert('team', [
            'name' => 'Italy',
            'power' => 7,
        ]);

        $this->insert('team', [
            'name' => 'Argentina',
            'power' => 8,
        ]);

        $this->insert('team', [
            'name' => 'France',
            'power' => 7,
        ]);

        $this->insert('team', [
            'name' => 'Uruguay',
            'power' => 7,
        ]);

        $this->insert('team', [
            'name' => 'England',
            'power' => 9,
        ]);

        $this->insert('team', [
            'name' => 'Spain',
            'power' => 9,
        ]);

        $this->insert('team', [
            'name' => 'Netherlands',
            'power' => 7,
        ]);

        $this->insert('team', [
            'name' => 'Czech Republic',
            'power' => 5,
        ]);

        $this->insert('team', [
            'name' => 'Cyprus',
            'power' => 3,
        ]);

        $this->insert('team', [
            'name' => 'Uzbekistan',
            'power' => 4,
        ]);

        $this->insert('team', [
            'name' => 'Croatia',
            'power' => 7,
        ]);

        $this->insert('team', [
            'name' => 'Poland',
            'power' => 4,
        ]);

        $this->insert('team', [
            'name' => 'South Korea',
            'power' => 5,
        ]);

        $this->insert('team', [
            'name' => 'Latvia',
            'power' => 3,
        ]);

        $this->insert('team', [
            'name' => 'Russia',
            'power' => 6,
        ]);

        $this->insert('team', [
            'name' => 'Japan',
            'power' => 5,
        ]);

        $this->insert('team', [
            'name' => 'Belgium',
            'power' => 6,
        ]);

        $this->insert('team', [
            'name' => 'Colombia',
            'power' => 6,
        ]);

        $this->insert('team', [
            'name' => 'Portugal',
            'power' => 9,
        ]);

        $this->insert('team', [
            'name' => 'Denmark',
            'power' => 6,
        ]);

        $this->insert('team', [
            'name' => 'Senegal',
            'power' => 5,
        ]);

        $this->insert('team', [
            'name' => 'Mexico',
            'power' => 7,
        ]);

        $this->insert('team', [
            'name' => 'Serbia',
            'power' => 4,
        ]);

        $this->insert('team', [
            'name' => 'Australia',
            'power' => 6,
        ]);

        $this->insert('team', [
            'name' => 'Egypt',
            'power' => 5,
        ]);

        $this->insert('team', [
            'name' => 'Finland',
            'power' => 4,
        ]);

        $this->insert('team', [
            'name' => 'USA',
            'power' => 4,
        ]);

        $this->insert('team', [
            'name' => 'Sweden',
            'power' => 5,
        ]);

        $this->insert('team', [
            'name' => 'Greece',
            'power' => 4,
        ]);

        $this->insert('team', [
            'name' => 'Ireland',
            'power' => 4,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('team'); // we can't use truncate method here
    }
}
