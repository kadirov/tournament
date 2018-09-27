<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Match\Components;

use Ka\Tournament\Modules\Common\Interfaces\Group\Models\GroupInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\MatchResultManagerInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\Models\MatchResultInterface;
use Ka\Tournament\Modules\Common\Interfaces\Team\Models\TeamInterface;
use Ka\Tournament\Modules\Match\Models\MatchResult;

class MatchResultManager implements MatchResultManagerInterface
{
    /**
     * @param MatchResultInterface|MatchResult $matchResult
     * @return mixed
     */
    public function save(MatchResultInterface $matchResult): bool
    {
        if ($matchResult->getTeam1()->getPlayOff()) {
            $matchResult->setPlayOff($matchResult->getTeam1()->getPlayOff());
        } elseif ($matchResult->getTeam1()->getGroup()) {
            $matchResult->setGroup($matchResult->getTeam1()->getGroup());
        }

        return $matchResult->save();
    }

    /**
     * @return mixed
     */
    public function truncate(): void
    {
        MatchResult::deleteAll();
    }

    /**
     * @param TeamInterface $team
     * @param GroupInterface $group
     * @return MatchResultInterface[]|[]
     */
    public function getTeamMatchesInGroup(TeamInterface $team, GroupInterface $group): array
    {
        return MatchResult::find()->teamMatchesInGroup($team, $group)->orderedDesk()->all();
    }
}
