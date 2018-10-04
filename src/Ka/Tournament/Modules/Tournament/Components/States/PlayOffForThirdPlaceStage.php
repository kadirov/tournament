<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Tournament\Components\States;

use Ka\Tournament\Modules\Common\Constants\TournamentState;
use Ka\Tournament\Modules\Common\Interfaces\Tournament\TournamentInterface;
use Ka\Tournament\Modules\Common\Interfaces\Tournament\TournamentStateInterface;

/**
 * Class PlayOffForThirdPlaceStage
 *
 * @package Ka\Tournament\Modules\Tournament\Components\States
 */
class PlayOffForThirdPlaceStage implements TournamentStateInterface
{
    /**
     * @return int A constant of {@see TournamentState}
     * @see TournamentState
     */
    public function getValue(): int
    {
        return TournamentState::PLAYOFF_FOR_THIRD_PLACE;
    }

    /**
     * Change state of tournament
     * @param \Ka\Tournament\Modules\Common\Interfaces\Tournament\TournamentInterface $tournament
     */
    public function toNextRound(TournamentInterface $tournament): void
    {
        $tournament->setState(new PlayOffFinalStage());
    }
}
