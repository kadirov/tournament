<?php

namespace Ka\Tournament\Modules\Match\Models;

use Ka\Tournament\Modules\Common\Interfaces\Group\Models\GroupInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\Models\MatchResultInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\Models\ScoreInterface;
use Ka\Tournament\Modules\Common\Interfaces\PlayOff\Models\PlayOffInterface;
use Ka\Tournament\Modules\Common\Interfaces\Team\Models\TeamInterface;
use Ka\Tournament\Modules\Group\Models\Group;
use Ka\Tournament\Modules\Match\Models\Query\MatchResultQuery;
use Ka\Tournament\Modules\PlayOff\Models\PlayOff;
use Ka\Tournament\Modules\Team\Models\Team;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "match_result".
 *
 * @property int $id
 * @property int $team1_id
 * @property int $team2_id
 * @property int $group_id
 * @property int $playoff_id
 * @property int $final_score
 * @property int $second_time_score
 * @property int $additional_times_score
 * @property int $penalties_score
 * @property Score $finalScore
 * @property Score $penaltiesScore
 * @property Score $secondTimeScore
 * @property Team $team1
 * @property Team $team2
 */
class MatchResult extends ActiveRecord implements MatchResultInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'match_result';
    }

    /**
     * {@inheritdoc}
     * @return MatchResultQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MatchResultQuery(static::class);
    }

    /**
     * @param ScoreInterface $score
     * @return MatchResult
     */
    public function setFinalScore(ScoreInterface $score): self
    {
        $this->final_score = $score->getId();
        return $this;
    }

    /**
     * @param ScoreInterface $score
     * @return MatchResult
     */
    public function setAdditionalScore(ScoreInterface $score): self
    {
        $this->additional_times_score = $score->getId();
        return $this;
    }

    /**
     * @param ScoreInterface $score
     * @return MatchResult
     */
    public function setPenaltiesScore(ScoreInterface $score): self
    {
        $this->penalties_score = $score->getId();
        return $this;
    }

    /**
     * @param ScoreInterface $score
     * @return MatchResult
     */
    public function setSecondTimeScore(ScoreInterface $score): self
    {
        $this->second_time_score = $score->getId();
        return $this;
    }

    /**
     * @param TeamInterface $team
     * @return MatchResult
     */
    public function setTeam1(TeamInterface $team): self
    {
        $this->team1_id = $team->getId();
        return $this;
    }

    /**
     * @param TeamInterface $team
     * @return MatchResult
     */
    public function setTeam2(TeamInterface $team): self
    {
        $this->team2_id = $team->getId();
        return $this;
    }

    /**
     * @param GroupInterface $group
     * @return MatchResult
     */
    public function setGroup(GroupInterface $group): self
    {
        $this->group_id = $group->getId();
        return $this;
    }

    /**
     * @return ScoreInterface|null|ActiveRecord
     */
    public function getAdditionalTimesScore(): ?ScoreInterface
    {
        return $this->hasOne(Score::class, ['id' => 'additional_times_score'])->one();
    }

    /**
     * @return GroupInterface|null|ActiveRecord
     */
    public function getGroup(): ?GroupInterface
    {
        return $this->hasOne(Group::class, ['id' => 'group_id'])->one();
    }

    /**
     * @return PlayOffInterface|null|ActiveRecord
     */
    public function getPlayOff(): ?PlayOffInterface
    {
        return $this->hasOne(PlayOff::class, ['id' => 'playoff_id'])->one();
    }

    /**
     * @param PlayOffInterface $playOff
     * @return MatchResult
     */
    public function setPlayOff(PlayOffInterface $playOff): self
    {
        $this->playoff_id = $playOff->getId();
        return $this;
    }

    /**
     * @return ScoreInterface|ActiveRecord
     */
    public function getFinalScore(): ScoreInterface
    {
        return $this->hasOne(Score::class, ['id' => 'final_score'])->one();
    }

    /**
     * @return ScoreInterface|null|ActiveRecord
     */
    public function getPenaltiesScore(): ?ScoreInterface
    {
        return $this->hasOne(Score::class, ['id' => 'penalties_score'])->one();
    }

    /**
     * @return ScoreInterface|ActiveRecord
     */
    public function getSecondTimeScore(): ScoreInterface
    {
        return $this->hasOne(Score::class, ['id' => 'second_time_score'])->one();
    }

    /**
     * @return TeamInterface|ActiveRecord
     */
    public function getTeam1(): TeamInterface
    {
        return $this->hasOne(Team::class, ['id' => 'team1_id'])->one();
    }

    /**
     * @return TeamInterface|ActiveRecord
     */
    public function getTeam2(): TeamInterface
    {
        return $this->hasOne(Team::class, ['id' => 'team2_id'])->one();
    }

    /**
     * Returns true if first team won
     *
     * @return bool
     */
    public function isFirstTeamWon(): bool
    {
        if ($this->getPenaltiesScore() !== null) {
            return $this->getPenaltiesScore()->getFirstTeamScore() > $this->getPenaltiesScore()->getSecondTeamScore();
        }

        return $this->getFinalScore()->getFirstTeamScore() > $this->getFinalScore()->getSecondTeamScore();
    }

    /**
     * Returns true if second team won
     *
     * @return bool
     */
    public function isSecondTeamWon(): bool
    {
        if ($this->getPenaltiesScore() !== null) {
            return $this->getPenaltiesScore()->getFirstTeamScore() < $this->getPenaltiesScore()->getSecondTeamScore();
        }

        return $this->getFinalScore()->getFirstTeamScore() < $this->getFinalScore()->getSecondTeamScore();
    }

    /**
     * Returns true if match has ended with draw
     *
     * @return bool
     */
    public function isDraw(): bool
    {
        if ($this->getPenaltiesScore() !== null) {
            return false;
        }

        return $this->getFinalScore()->getFirstTeamScore() === $this->getFinalScore()->getSecondTeamScore();
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['team1_id', 'team2_id', 'final_score', 'second_time_score'], 'required'],
            [
                [
                    'team1_id',
                    'team2_id',
                    'group_id',
                    'playoff_id',
                    'final_score',
                    'second_time_score',
                    'additional_times_score',
                    'penalties_score'
                ],
                'integer'
            ],
            [
                ['additional_times_score'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Score::class,
                'targetAttribute' => ['additional_times_score' => 'id']
            ],
            [
                ['final_score'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Score::class,
                'targetAttribute' => ['final_score' => 'id']
            ],
            [
                ['group_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Group::class,
                'targetAttribute' => ['group_id' => 'id']
            ],
            [
                ['playoff_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => PlayOff::class,
                'targetAttribute' => ['playoff_id' => 'id']
            ],
            [
                ['penalties_score'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Score::class,
                'targetAttribute' => ['penalties_score' => 'id']
            ],
            [
                ['second_time_score'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Score::class,
                'targetAttribute' => ['second_time_score' => 'id']
            ],
            [
                ['team1_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Team::class,
                'targetAttribute' => ['team1_id' => 'id']
            ],
            [
                ['team2_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Team::class,
                'targetAttribute' => ['team2_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'team1_id' => 'Team1 ID',
            'team2_id' => 'Team2 ID',
            'group_id' => 'Group ID',
            'playoff_id' => 'PlayOff ID',
            'final_score' => 'Final Score',
            'second_time_score' => 'Second Time Score',
            'additional_times_score' => 'Additional Time Score',
            'penalties_score' => 'Penalties Score',
        ];
    }
}
