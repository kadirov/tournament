<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\PlayOff\Helpers;

use Ka\Tournament\Modules\Common\Interfaces\Team\Models\TeamInterface;

/**
 * Class PlayOffHelper
 *
 * @package Ka\Tournament\Modules\PlayOff\Helpers
 */
class PlayOffHelper
{
    /**
     * @param string $playOffLabel
     * @param TeamInterface[]|array $teams
     * @return TeamInterface|null
     */
    public static function find(string $playOffLabel, array $teams): ?TeamInterface
    {
        foreach ($teams as $team) {
            if ($team->getPlayOff() === null) {
                continue;
            }

            if ($team->getPlayOff()->getLabel() === $playOffLabel) {
                return $team;
            }
        }

        return null;
    }
}
