<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Common\Interfaces\Team;

use Ka\Tournament\Modules\Common\Interfaces\Team\Models\TeamInterface;

/**
 * Interface TeamManagerInterface
 * @package Ka\Tournament\Modules\Common\Interfaces\Team
 */
interface TeamManagerInterface
{
    /**
     * Clear relations
     *
     * @return void
     */
    public function clear(): void;

    /**
     * @return TeamInterface[]|array
     */
    public function getAll(): array;

    /**
     * Get Teams in PlayOff
     * @return TeamInterface[]
     */
    public function getTeamsInPlayOff(): array;

    /**
     * @param TeamInterface $team
     * @return bool
     */
    public function save(TeamInterface $team): bool;
}
