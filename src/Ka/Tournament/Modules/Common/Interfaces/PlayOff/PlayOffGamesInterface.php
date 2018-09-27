<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Common\Interfaces\PlayOff;

use Ka\Tournament\Modules\Common\Interfaces\Tournament\TournamentStateInterface;

interface PlayOffGamesInterface
{
    /**
     * Play one round of group
     * @param TournamentStateInterface $tournamentState
     */
    public function playRound(TournamentStateInterface $tournamentState): void;
}
