<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Group\Components;

use Ka\Tournament\Modules\Common\Interfaces\Group\DrawingGroupInterface;
use Ka\Tournament\Modules\Common\Interfaces\Group\GroupManagerInterface;
use Ka\Tournament\Modules\Common\Interfaces\Group\Models\GroupInterface;
use Ka\Tournament\Modules\Common\Interfaces\Team\Models\TeamInterface;
use Ka\Tournament\Modules\Common\Interfaces\Team\TeamManagerInterface;
use LogicException;

/**
 * Class uses to define teams for groups
 *
 * @package Ka\Tournament\Modules\Group\Components
 */
class DrawingGroup implements DrawingGroupInterface
{
    /**
     * @var GroupManagerInterface
     */
    private $groupManager;
    /**
     * @var TeamManagerInterface
     */
    private $teamManager;

    /**
     * DrawingGroup constructor.
     * @param TeamManagerInterface $teamManager
     * @param GroupManagerInterface $groupManager
     */
    public function __construct(TeamManagerInterface $teamManager, GroupManagerInterface $groupManager)
    {
        $this->teamManager = $teamManager;
        $this->groupManager = $groupManager;
    }

    /**
     * Draw.
     *
     * Define Teams for Groups
     */
    public function draw(): void
    {
        $teams = $this->getTeams();
        $groups = $this->getGroups();
        $numberOfTeamsInGroup = \count($teams) / \count($groups);

        shuffle($teams);

        $teamId = 0;
        foreach ($groups as $group) {
            for ($i = 0; $i < $numberOfTeamsInGroup; $i++, $teamId++) {
                if (!isset($teams[$teamId])) {
                    return;
                }

                $teams[$teamId]->setGroup($group);
                $this->getTeamManager()->save($teams[$teamId]);
            }
        }
    }

    /**
     * @return GroupManagerInterface
     */
    private function getGroupManager(): GroupManagerInterface
    {
        return $this->groupManager;
    }

    /**
     * @return GroupInterface[]|[]
     */
    private function getGroups(): array
    {
        $groups = $this->getGroupManager()->getAll();

        if (empty($groups)) {
            throw new LogicException('Groups not found!');
        }

        return $groups;
    }

    /**
     * @return TeamManagerInterface
     */
    private function getTeamManager(): TeamManagerInterface
    {
        return $this->teamManager;
    }

    /**
     * @return TeamInterface[]|[]
     */
    private function getTeams(): array
    {
        $teams = $this->getTeamManager()->getAll();

        if (empty($teams)) {
            throw new LogicException('Teams not found!');
        }

        return $teams;
    }
}
