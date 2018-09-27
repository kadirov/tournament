<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Common\Interfaces\Group\Models;

use Ka\Tournament\Modules\Common\Interfaces\Team\Models\TeamInterface;

interface GroupResultInterface
{
    /**
     * @return GroupInterface
     */
    public function getGroup(): GroupInterface;

    /**
     * @return TeamInterface
     */
    public function getTeam(): TeamInterface;

    /**
     * @return int
     */
    public function getPosition(): int;

    /**
     * @return int
     */
    public function getPoint(): int;

    /**
     * @return int
     */
    public function getGoalDifference(): int;

    /**
     * @return int
     */
    public function getGamesPlayed(): int;

    /**
     * @return int
     */
    public function getGamesWon(): int;

    /**
     * @return int
     */
    public function getGamesDrawn(): int;

    /**
     * @return int
     */
    public function getGamesLost(): int;
}
