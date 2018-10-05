<?php

namespace Ka\Tournament\Modules\Tournament\Controllers;

use Ka\Tournament\Modules\Common\Interfaces\Group\GroupManagerInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\MatchResultManagerInterface;
use Ka\Tournament\Modules\Common\Interfaces\Tournament\Memento\TournamentCaretakerInterface;
use Ka\Tournament\Modules\Common\Interfaces\Tournament\TournamentInterface;
use yii\base\Module;
use yii\web\Controller;
use yii\web\Response;

/**
 * Default controller for the `tournament` module
 */
class DefaultController extends Controller
{
    /**
     * @var TournamentInterface
     */
    private $tournament;

    /**
     * @var TournamentCaretakerInterface
     */
    private $tournamentCaretaker;

    /**
     * DefaultController constructor.
     * @param string $id
     * @param Module $module
     * @param \Ka\Tournament\Modules\Common\Interfaces\Tournament\TournamentInterface $tournament
     * @param TournamentCaretakerInterface $tournamentCaretaker
     */
    public function __construct(
        string $id,
        Module $module,
        TournamentInterface $tournament,
        TournamentCaretakerInterface $tournamentCaretaker
    )
    {
        $this->tournament = $tournament;

        parent::__construct($id, $module);
        $this->tournamentCaretaker = $tournamentCaretaker;
    }

    /**
     * @return Response
     */
    public function actionNext()
    {
        $this->getTournamentCaretaker()->load($this->getTournament());
        $this->getTournament()->playRound();
        $this->getTournamentCaretaker()->save($this->getTournament());

        return $this->redirect('/match');
    }

    /**
     * @return Response
     */
    public function actionReset(): Response
    {
        $this->getTournament()->reset();
        $this->getTournament()->playRound();
        $this->getTournamentCaretaker()->save($this->getTournament());

        return $this->redirect('/group');
    }

    /**
     * @return \Ka\Tournament\Modules\Common\Interfaces\Tournament\TournamentInterface
     */
    private function getTournament(): TournamentInterface
    {
        return $this->tournament;
    }

    /**
     * @return TournamentCaretakerInterface
     */
    private function getTournamentCaretaker(): TournamentCaretakerInterface
    {
        return $this->tournamentCaretaker;
    }
}
