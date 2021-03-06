<?php

namespace Ka\Tournament\Modules\Match\Models;

use Ka\Tournament\Modules\Common\Interfaces\Match\Models\ScoreInterface;
use Ka\Tournament\Modules\Match\Models\Query\ScoreQuery;

/**
 * This is the model class for table "score".
 *
 * @property int $id
 * @property int $first_team_score
 * @property int $second_team_score
 */
class Score extends \yii\db\ActiveRecord implements ScoreInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'score';
    }

    /**
     * {@inheritdoc}
     * @return ScoreQuery the active query used by this AR class.
     */
    public static function find(): ScoreQuery
    {
        return new ScoreQuery(static::class);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Score of first team
     *
     * @return int
     */
    public function getFirstTeamScore(): int
    {
        return $this->first_team_score;
    }

    /**
     * Score of second team
     *
     * @return int
     */
    public function getSecondTeamScore(): int
    {
        return $this->second_team_score;
    }

    /**
     * Score of first team
     *
     * @param int $score
     * @return Score
     */
    public function setFirstTeamScore(int $score): self
    {
        $this->first_team_score = $score;
        return $this;
    }

    /**
     * Score of second team
     *
     * @param int $score
     * @return Score
     */
    public function setSecondTeamScore(int $score): self
    {
        $this->second_team_score = $score;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['first_team_score', 'second_team_score'], 'required'],
            [['first_team_score', 'second_team_score'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'first_team_score' => 'First Team Score',
            'second_team_score' => 'Second Team Score',
        ];
    }
}
