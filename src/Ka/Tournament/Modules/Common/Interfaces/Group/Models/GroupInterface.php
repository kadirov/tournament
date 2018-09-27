<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Common\Interfaces\Group\Models;

use Ka\Tournament\Modules\Common\Interfaces\Core\IdInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\Models\MatchResultInterface;
use Ka\Tournament\Modules\Common\Interfaces\Team\Models\TeamInterface;

interface GroupInterface extends IdInterface
{
    /**
     * Get group label, a letter. ex: A, B or C
     *
     * @return string
     */
    public function getLabel(): string;

    /**
     * Returns list of {@see TeamInterface} in a group
     *
     * @see TeamInterface
     * @return TeamInterface[]|[]
     */
    public function getTeams(): array;

    /**
     * Get all match results of games in a group
     *
     * @return MatchResultInterface[]|[]
     */
    public function getMatchResults(): array;
}
