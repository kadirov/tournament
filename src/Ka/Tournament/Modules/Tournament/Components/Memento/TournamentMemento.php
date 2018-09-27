<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Tournament\Components\Memento;

use Ka\Tournament\Modules\Common\Interfaces\Tournament\Memento\TournamentMementoInterface;
use Ka\Tournament\Modules\Common\Interfaces\Tournament\TournamentStateInterface;

class TournamentMemento implements TournamentMementoInterface
{
    /**
     * @var TournamentStateInterface
     */
    private $state;

    /**
     * TournamentMemento constructor.
     * @param TournamentStateInterface $state
     */
    public function __construct(TournamentStateInterface $state)
    {
        $this->state = $state;
    }

    /**
     * @return TournamentStateInterface
     */
    public function getState(): TournamentStateInterface
    {
        return $this->state;
    }
}
