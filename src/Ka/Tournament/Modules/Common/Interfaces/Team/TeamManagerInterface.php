<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Common\Interfaces\Team;

use Ka\Tournament\Modules\Common\Interfaces\Team\Models\TeamInterface;

interface TeamManagerInterface
{
    /**
     * @return TeamInterface[]|array
     */
    public function getAll(): array;

    /**
     * @param TeamInterface $team
     * @return bool
     */
    public function save(TeamInterface $team): bool;

    /**
     * Clear relations
     *
     * @return void
     */
    public function clear(): void;

    /**
     * Get Teams in PlayOff
     * @return TeamInterface[]
     */
    public function getTeamsInPlayOff(): array;
}
