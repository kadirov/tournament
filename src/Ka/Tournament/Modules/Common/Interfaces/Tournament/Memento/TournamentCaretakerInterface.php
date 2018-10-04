<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Common\Interfaces\Tournament\Memento;

use Ka\Tournament\Modules\Common\Interfaces\Tournament\TournamentInterface;

/**
 * Interface TournamentCaretakerInterface
 * @package Ka\Tournament\Modules\Common\Interfaces\Tournament\Memento
 */
interface TournamentCaretakerInterface
{
    /**
     * Load Tournament state
     * @param TournamentInterface $tournament
     */
    public function load(TournamentInterface $tournament): void;

    /**
     * Save Tournament state
     * @param TournamentInterface $tournament
     */
    public function save(TournamentInterface $tournament): void;
}
