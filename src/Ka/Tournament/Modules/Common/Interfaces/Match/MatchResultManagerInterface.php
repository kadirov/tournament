<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Common\Interfaces\Match;

use Ka\Tournament\Modules\Common\Interfaces\Group\Models\GroupInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\Models\MatchResultInterface;
use Ka\Tournament\Modules\Common\Interfaces\Team\Models\TeamInterface;

interface MatchResultManagerInterface
{
    /**
     * @param MatchResultInterface $matchResult
     * @return mixed
     */
    public function save(MatchResultInterface $matchResult): bool;

    /**
     * @return void
     */
    public function truncate(): void;

    /**
     * @param TeamInterface $team
     * @param GroupInterface $group
     * @return MatchResultInterface[]|[]
     */
    public function getTeamMatchesInGroup(TeamInterface $team, GroupInterface $group): array;

    /**
     * @param TeamInterface $team
     * @return MatchResultInterface[]|[]
     */
    public function getTeamMatches(TeamInterface $team): array;

    /**
     * @param GroupInterface $group
     * @return MatchResultInterface[]|[]
     */
    public function getMatchesInGroup(GroupInterface $group): array;
}
