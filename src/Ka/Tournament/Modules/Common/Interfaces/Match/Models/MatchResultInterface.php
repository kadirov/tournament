<?php

namespace Ka\Tournament\Modules\Common\Interfaces\Match\Models;

use Ka\Tournament\Modules\Common\Interfaces\Group\Models\GroupInterface;
use Ka\Tournament\Modules\Common\Interfaces\PlayOff\Models\PlayOffInterface;
use Ka\Tournament\Modules\Common\Interfaces\Team\Models\TeamInterface;

interface MatchResultInterface
{
    /**
     * Get first team of the match
     *
     * @return TeamInterface
     */
    public function getTeam1(): TeamInterface;

    /**
     * Get second team of the match
     *
     * @return TeamInterface
     */
    public function getTeam2(): TeamInterface;

    /**
     * If it's a match in a group, you can get {@see GroupInterface}
     *
     * @see GroupInterface
     * @return GroupInterface|null
     */
    public function getGroup(): ?GroupInterface;

    /**
     * If it's a playOff match, you can get {@see PlayOffInterface}
     *
     * @see PlayOffInterface
     * @return PlayOffInterface|null
     */
    public function getPlayOff(): ?PlayOffInterface;

    /**
     * Get match score
     *
     * @return ScoreInterface
     */
    public function getFinalScore(): ScoreInterface;

    /**
     * Get score of second time
     *
     * @return ScoreInterface
     */
    public function getSecondTimeScore(): ScoreInterface;

    /**
     * Get score of additional times
     *
     * Method returns null if match had not additional times
     *
     * @return ScoreInterface|null
     */
    public function getAdditionalTimesScore(): ?ScoreInterface;

    /**
     * Get score of penalties
     *
     * Method returns null if match had not penalties
     *
     * @return ScoreInterface|null
     */
    public function getPenaltiesScore(): ?ScoreInterface;

    /**
     * Returns true if first team won
     *
     * @return bool
     */
    public function isFirstTeamWon(): bool;

    /**
     * Returns true if second team won
     *
     * @return bool
     */
    public function isSecondTeamWon(): bool;

    /**
     * Returns true if match has ended with draw
     *
     * @return bool
     */
    public function isDraw(): bool;
}
