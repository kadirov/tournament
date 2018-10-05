<?php

namespace Ka\Tournament\Modules\Common\Interfaces\Match;

use Ka\Tournament\Modules\Common\Interfaces\Match\Models\ScoreInterface;

interface ScoreGeneratorInterface
{
    /**
     * @param int $minScore
     * @param int $maxScore
     * @return ScoreInterface
     */
    public function winFirstTeam(int $minScore, int $maxScore): ScoreInterface;

    /**
     * @param int $minScore
     * @param int $maxScore
     * @return ScoreInterface
     */
    public function winSecondTeam(int $minScore, int $maxScore): ScoreInterface;

    /**
     * @param int $minScore
     * @param int $maxScore
     * @return ScoreInterface
     */
    public function draw(int $minScore, int $maxScore): ScoreInterface;
}
