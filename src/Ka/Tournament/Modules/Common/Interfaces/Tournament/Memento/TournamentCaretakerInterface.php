<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Common\Interfaces\Tournament\Memento;

use Ka\Tournament\Modules\Common\Interfaces\Tournament\TournamentInterface;

interface TournamentCaretakerInterface
{
    /**
     * Save Tournament state
     * @param TournamentInterface $tournament
     */
    public function save(TournamentInterface $tournament): void;

    /**
     * Load Tournament state
     * @param TournamentInterface $tournament
     */
    public function load(TournamentInterface $tournament): void;
}
