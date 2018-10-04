<?php
declare(strict_types=1);

namespace Ka\Tournament\Modules\Common\Interfaces\Match;

use Ka\Tournament\Modules\Common\Interfaces\Match\Models\MatchResultInterface;
use Ka\Tournament\Modules\Common\Interfaces\Team\Models\TeamInterface;

/**
 * Interface MatchResultBuilderInterface
 * @package Ka\Tournament\Modules\Common\Interfaces\Match
 */
interface MatchResultBuilderInterface
{
    /**
     * Generate and return {@see MatchResultInterface}
     *
     * @see \Ka\Tournament\Modules\Common\Interfaces\Match\Models\MatchResultInterface
     * @param TeamInterface $team1
     * @param TeamInterface $team2
     * @param bool $drawAllowed
     * @return \Ka\Tournament\Modules\Common\Interfaces\Match\Models\MatchResultInterface
     */
    public function build(TeamInterface $team1, TeamInterface $team2, bool $drawAllowed = null): MatchResultInterface;
}
