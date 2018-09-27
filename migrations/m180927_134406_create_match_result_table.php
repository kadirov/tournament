<?php

use yii\db\Migration;

/**
 * Handles the creation of table `match_result`.
 * Has foreign keys to the tables:
 *
 * - `team`
 * - `team`
 * - `group`
 * - `score`
 * - `score`
 * - `score`
 * - `score`
 */
class m180927_134406_create_match_result_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('match_result', [
            'id' => $this->primaryKey(),
            'team1_id' => $this->integer()->notNull(),
            'team2_id' => $this->integer()->notNull(),
            'group_id' => $this->integer()->null(),
            'playoff_id' => $this->integer()->null(),
            'final_score' => $this->integer()->notNull(),
            'second_time_score' => $this->integer()->notNull(),
            'additional_times_score' => $this->integer()->null(),
            'penalties_score' => $this->integer()->null(),
        ]);

        // creates index for column `team1_id`
        $this->createIndex(
            'idx-match_result-team1_id',
            'match_result',
            'team1_id'
        );

        // add foreign key for table `team`
        $this->addForeignKey(
            'fk-match_result-team1_id',
            'match_result',
            'team1_id',
            'team',
            'id',
            'CASCADE'
        );

        // creates index for column `team2_id`
        $this->createIndex(
            'idx-match_result-team2_id',
            'match_result',
            'team2_id'
        );

        // add foreign key for table `team`
        $this->addForeignKey(
            'fk-match_result-team2_id',
            'match_result',
            'team2_id',
            'team',
            'id',
            'CASCADE'
        );

        // creates index for column `group_id`
        $this->createIndex(
            'idx-match_result-group_id',
            'match_result',
            'group_id'
        );

        // add foreign key for table `group`
        $this->addForeignKey(
            'fk-match_result-group_id',
            'match_result',
            'group_id',
            'group',
            'id',
            'CASCADE'
        );

        // creates index for column `playoff_id`
        $this->createIndex(
            'idx-match_result-playoff_id',
            'match_result',
            'playoff_id'
        );

        // add foreign key for table `playoff`
        $this->addForeignKey(
            'fk-match_result-playoff_id',
            'match_result',
            'playoff_id',
            'playoff',
            'id',
            'CASCADE'
        );

        // creates index for column `final_score`
        $this->createIndex(
            'idx-match_result-final_score',
            'match_result',
            'final_score'
        );

        // add foreign key for table `score`
        $this->addForeignKey(
            'fk-match_result-final_score',
            'match_result',
            'final_score',
            'score',
            'id',
            'CASCADE'
        );

        // creates index for column `second_time_score`
        $this->createIndex(
            'idx-match_result-second_time_score',
            'match_result',
            'second_time_score'
        );

        // add foreign key for table `score`
        $this->addForeignKey(
            'fk-match_result-second_time_score',
            'match_result',
            'second_time_score',
            'score',
            'id',
            'CASCADE'
        );

        // creates index for column `additional_times_score`
        $this->createIndex(
            'idx-match_result-additional_times_score',
            'match_result',
            'additional_times_score'
        );

        // add foreign key for table `score`
        $this->addForeignKey(
            'fk-match_result-additional_times_score',
            'match_result',
            'additional_times_score',
            'score',
            'id',
            'CASCADE'
        );

        // creates index for column `penalties_score`
        $this->createIndex(
            'idx-match_result-penalties_score',
            'match_result',
            'penalties_score'
        );

        // add foreign key for table `score`
        $this->addForeignKey(
            'fk-match_result-penalties_score',
            'match_result',
            'penalties_score',
            'score',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `team`
        $this->dropForeignKey(
            'fk-match_result-team1_id',
            'match_result'
        );

        // drops index for column `team1_id`
        $this->dropIndex(
            'idx-match_result-team1_id',
            'match_result'
        );

        // drops foreign key for table `team`
        $this->dropForeignKey(
            'fk-match_result-team2_id',
            'match_result'
        );

        // drops index for column `team2_id`
        $this->dropIndex(
            'idx-match_result-team2_id',
            'match_result'
        );

        // drops foreign key for table `group`
        $this->dropForeignKey(
            'fk-match_result-group_id',
            'match_result'
        );

        // drops index for column `group_id`
        $this->dropIndex(
            'idx-match_result-group_id',
            'match_result'
        );

        // drops foreign key for table `playoff`
        $this->dropForeignKey(
            'fk-match_result-playoff_id',
            'match_result'
        );

        // drops index for column `playoff_id`
        $this->dropIndex(
            'idx-match_result-playoff_id',
            'match_result'
        );

        // drops foreign key for table `score`
        $this->dropForeignKey(
            'fk-match_result-final_score',
            'match_result'
        );

        // drops index for column `final_score`
        $this->dropIndex(
            'idx-match_result-final_score',
            'match_result'
        );

        // drops foreign key for table `score`
        $this->dropForeignKey(
            'fk-match_result-second_time_score',
            'match_result'
        );

        // drops index for column `second_time_score`
        $this->dropIndex(
            'idx-match_result-second_time_score',
            'match_result'
        );

        // drops foreign key for table `score`
        $this->dropForeignKey(
            'fk-match_result-additional_times_score',
            'match_result'
        );

        // drops index for column `additional_times_score`
        $this->dropIndex(
            'idx-match_result-additional_times_score',
            'match_result'
        );

        // drops foreign key for table `score`
        $this->dropForeignKey(
            'fk-match_result-penalties_score',
            'match_result'
        );

        // drops index for column `penalties_score`
        $this->dropIndex(
            'idx-match_result-penalties_score',
            'match_result'
        );

        $this->dropTable('match_result');
    }
}
