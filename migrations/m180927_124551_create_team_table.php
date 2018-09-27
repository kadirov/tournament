<?php

use yii\db\Migration;

/**
 * Handles the creation of table `team`.
 * Has foreign keys to the tables:
 *
 * - `group`
 */
class m180927_124551_create_team_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('team', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'power' => $this->tinyInteger()->notNull(),
            'group_id' => $this->integer()->null(),
            'playoff_id' => $this->integer()->null(),
        ]);

        // creates index for column `group_id`
        $this->createIndex(
            'idx-team-group_id',
            'team',
            'group_id'
        );

        // add foreign key for table `group`
        $this->addForeignKey(
            'fk-team-group_id',
            'team',
            'group_id',
            'group',
            'id',
            'CASCADE'
        );

        // creates index for column `playoff_id`
        $this->createIndex(
            'idx-team-playoff_id',
            'team',
            'playoff_id'
        );

        // add foreign key for table `playoff`
        $this->addForeignKey(
            'fk-team-playoff_id',
            'team',
            'playoff_id',
            'playoff',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `group`
        $this->dropForeignKey(
            'fk-team-group_id',
            'team'
        );

        // drops index for column `group_id`
        $this->dropIndex(
            'idx-team-group_id',
            'team'
        );

        // drops foreign key for table `group`
        $this->dropForeignKey(
            'fk-team-playoff_id',
            'team'
        );

        // drops index for column `group_id`
        $this->dropIndex(
            'idx-team-playoff_id',
            'team'
        );

        $this->dropTable('team');
    }
}
