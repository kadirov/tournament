<?php

namespace Ka\Tournament\Modules\Common\Interfaces\Match;

use Ka\Tournament\Modules\Common\Interfaces\Match\Models\MatchResultInterface;
use Ka\Tournament\Modules\Common\Interfaces\Team\Models\TeamInterface;

interface MatchResultBuilderInterface
{
    /**
     * Generate and return {@see MatchResultInterface}
     *
     * @see MatchResultInterface
     * @param TeamInterface $team1
     * @param TeamInterface $team2
     * @param MatchResultBuilderStrategy $strategy
     * @return MatchResultInterface
     */
    public function build(TeamInterface $team1, TeamInterface $team2, MatchResultBuilderStrategy $strategy): MatchResultInterface;
}
