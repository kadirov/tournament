<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Team\Components;

use Ka\Tournament\Modules\Common\Interfaces\Team\Models\TeamInterface;
use Ka\Tournament\Modules\Common\Interfaces\Team\TeamManagerInterface;
use Ka\Tournament\Modules\Team\Models\Team;

/**
 * Class TeamManager
 *
 * @package Ka\Tournament\Modules\Team\Components
 */
class TeamManager implements TeamManagerInterface
{
    /**
     * Clear relations
     *
     * @return void
     */
    public function clear(): void
    {
        foreach (Team::find()->all() as $team) {
            $team->setGroup(null);
            $team->setPlayOff(null);
            $team->save();
        }
    }

    /**
     * @return TeamInterface[]|array
     */
    public function getAll(): array
    {
        return Team::find()->all();
    }

    /**
     * Get Teams in PlayOff
     * @return TeamInterface[]
     */
    public function getTeamsInPlayOff(): array
    {
        return Team::find()->hasPlayOff()->all();
    }

    /**
     * @param TeamInterface|Team $team
     * @return bool
     */
    public function save(TeamInterface $team): bool
    {
        return $team->save();
    }
}
