<?php

namespace Ka\Tournament\Modules\Common\Interfaces\Tournament;

use Ka\Tournament\Modules\Common\Constants\TournamentState;

interface TournamentStateInterface
{
    /**
     * Change state of tournament
     * @param TournamentInterface $tournament
     */
    public function toNextRound(TournamentInterface $tournament): void;

    /**
     * @return int A constant of {@see TournamentState}
     * @see TournamentState
     */
    public function getValue(): int;
}
