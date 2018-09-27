<?php

namespace Ka\Tournament\Modules\Common\Interfaces\Tournament\Memento;

use Ka\Tournament\Modules\Common\Interfaces\Tournament\TournamentStateInterface;

/**
 * Interface MementoInterface
 * @package Ka\Tournament\Modules\Common\Interfaces\Tournament\Memento
 */
interface TournamentMementoInterface
{
    /**
     * @return TournamentStateInterface
     */
    public function getState(): TournamentStateInterface;
}
