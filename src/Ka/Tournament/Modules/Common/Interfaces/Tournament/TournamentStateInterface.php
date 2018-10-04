<?php
declare(strict_types=1);

namespace Ka\Tournament\Modules\Common\Interfaces\Tournament;

use Ka\Tournament\Modules\Common\Constants\TournamentState;

/**
 * Interface TournamentStateInterface
 * @package Ka\Tournament\Modules\Common\Interfaces\Tournament
 */
interface TournamentStateInterface
{
    /**
     * @return int A constant of {@see TournamentState}
     * @see TournamentState
     */
    public function getValue(): int;

    /**
     * Change state of tournament
     * @param TournamentInterface $tournament
     */
    public function toNextRound(TournamentInterface $tournament): void;
}
