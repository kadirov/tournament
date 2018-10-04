<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Common\Interfaces\Tournament;

/**
 * Interface TournamentInterface
 * @package Ka\Tournament\Modules\Common\Interfaces\Tournament
 */
interface TournamentInterface
{
    /**
     * @return TournamentStateInterface
     */
    public function getState(): TournamentStateInterface;

    /**
     * Play one round of tournament
     */
    public function playRound(): void;

    /**
     * Reset all data and progress
     */
    public function reset(): void;

    /**
     * @param TournamentStateInterface $state
     */
    public function setState(TournamentStateInterface $state): void;
}
