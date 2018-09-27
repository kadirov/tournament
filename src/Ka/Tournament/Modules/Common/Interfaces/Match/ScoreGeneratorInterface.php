<?php

namespace Ka\Tournament\Modules\Common\Interfaces\Match;

use Ka\Tournament\Modules\Common\Interfaces\Match\Models\ScoreInterface;

interface ScoreGeneratorInterface
{
    /**
     * @return ScoreInterface
     */
    public function winFirstTeam(): ScoreInterface;

    /**
     * @return ScoreInterface
     */
    public function winSecondTeam(): ScoreInterface;

    /**
     * @return ScoreInterface
     */
    public function draw(): ScoreInterface;
}
