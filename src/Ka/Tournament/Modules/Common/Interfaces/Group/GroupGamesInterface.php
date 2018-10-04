<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Common\Interfaces\Group;

use Ka\Tournament\Modules\Common\Interfaces\Tournament\TournamentStateInterface;

/**
 * Interface GroupGamesInterface
 * @package Ka\Tournament\Modules\Common\Interfaces\Group
 */
interface GroupGamesInterface
{
    /**
     * Play one round of group
     * @param TournamentStateInterface $tournamentState
     */
    public function playRound(TournamentStateInterface $tournamentState): void;
}
