<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Tournament\Components\Memento;

use Ka\Tournament\Modules\Common\Interfaces\Tournament\Memento\TournamentCaretakerInterface;
use Ka\Tournament\Modules\Common\Interfaces\Tournament\TournamentInterface;

class TournamentCaretaker implements TournamentCaretakerInterface
{
    private const FILE_PATH = '@app/runtime/tournamentMemento';

    /**
     * Save Tournament state
     * @param TournamentInterface $tournament
     */
    public function save(TournamentInterface $tournament): void
    {
        $serializedMemento = serialize(new TournamentMemento($tournament->getState()));
        file_put_contents(\Yii::getAlias(self::FILE_PATH), $serializedMemento);
    }

    /**
     * Load Tournament state
     * @param TournamentInterface $tournament
     */
    public function load(TournamentInterface $tournament): void
    {
        if (file_exists(\Yii::getAlias(self::FILE_PATH))) {
            $serializedMemento = file_get_contents(\Yii::getAlias(self::FILE_PATH));
            $tournament->setState(unserialize($serializedMemento)->getState());
            return;
        }

        $tournament->reset();
    }
}
