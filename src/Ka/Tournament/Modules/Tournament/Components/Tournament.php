<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Tournament\Components;

use Ka\Tournament\Modules\Common\Constants\TournamentState;
use Ka\Tournament\Modules\Common\Interfaces\Group\DrawingGroupInterface;
use Ka\Tournament\Modules\Common\Interfaces\Group\GroupGamesInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\MatchResultManagerInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\ScoreManagerInterface;
use Ka\Tournament\Modules\Common\Interfaces\PlayOff\PlayOffGamesInterface;
use Ka\Tournament\Modules\Common\Interfaces\Team\TeamManagerInterface;
use Ka\Tournament\Modules\Common\Interfaces\Tournament\TournamentInterface;
use Ka\Tournament\Modules\Common\Interfaces\Tournament\TournamentStateInterface;
use Ka\Tournament\Modules\Tournament\Components\States\DrawStage;

/**
 * Class Tournament
 *
 * @package Ka\Tournament\Modules\Tournament\Components
 */
class Tournament implements TournamentInterface
{
    /**
     * @var DrawingGroupInterface
     */
    private $drawingGroup;
    /**
     * @var GroupGamesInterface
     */
    private $groupGames;
    /**
     * @var MatchResultManagerInterface
     */
    private $matchResultManager;
    /**
     * @var PlayOffGamesInterface
     */
    private $playOffGames;
    /**
     * @var ScoreManagerInterface
     */
    private $scoreManager;
    /**
     * @var TournamentStateInterface
     */
    private $state;
    /**
     * @var TeamManagerInterface
     */
    private $teamManager;

    /**
     * Tournament constructor.
     * @param DrawingGroupInterface $drawingGroup
     * @param GroupGamesInterface $groupGames
     * @param PlayOffGamesInterface $playOffGames
     * @param MatchResultManagerInterface $matchResultManager
     * @param TeamManagerInterface $teamManager
     * @param ScoreManagerInterface $scoreManager
     */
    public function __construct(
        DrawingGroupInterface $drawingGroup,
        GroupGamesInterface $groupGames,
        PlayOffGamesInterface $playOffGames,
        MatchResultManagerInterface $matchResultManager,
        TeamManagerInterface $teamManager,
        ScoreManagerInterface $scoreManager
    ) {
        $this->drawingGroup = $drawingGroup;
        $this->groupGames = $groupGames;
        $this->matchResultManager = $matchResultManager;
        $this->scoreManager = $scoreManager;
        $this->playOffGames = $playOffGames;
        $this->teamManager = $teamManager;
    }

    /**
     * @return TournamentStateInterface
     */
    public function getState(): TournamentStateInterface
    {
        if ($this->state === null) {
            $this->state = new DrawStage();
        }

        return $this->state;
    }

    /**
     * Play one round of tournament
     */
    public function playRound(): void
    {
        if ($this->getState()->getValue() === TournamentState::FINISHED) {
            return;
        }

        if ($this->getState()->getValue() === TournamentState::DRAW) {
            $this->getDrawingGroup()->draw();
            $this->getState()->toNextRound($this);
            return;
        }

        if ($this->getState()->getValue() < TournamentState::PLAYOFF_PREPARE) {
            $this->getGroupGames()->playRound($this->getState());
        } else {
            $this->getPlayOffGames()->playRound($this->getState());
        }

        $this->getState()->toNextRound($this);
    }

    /**
     * Reset all data and progress
     */
    public function reset(): void
    {
        $this->getMatchResultManager()->truncate();
        $this->getTeamManager()->clear();
        $this->getScoreManager()->truncate();
    }

    /**
     * @param TournamentStateInterface $state
     */
    public function setState(TournamentStateInterface $state): void
    {
        $this->state = $state;
    }

    /**
     * @return DrawingGroupInterface
     */
    private function getDrawingGroup(): DrawingGroupInterface
    {
        return $this->drawingGroup;
    }

    /**
     * @return GroupGamesInterface
     */
    private function getGroupGames(): GroupGamesInterface
    {
        return $this->groupGames;
    }

    /**
     * @return MatchResultManagerInterface
     */
    private function getMatchResultManager(): MatchResultManagerInterface
    {
        return $this->matchResultManager;
    }

    /**
     * @return PlayOffGamesInterface
     */
    private function getPlayOffGames(): PlayOffGamesInterface
    {
        return $this->playOffGames;
    }

    /**
     * @return ScoreManagerInterface
     */
    private function getScoreManager(): ScoreManagerInterface
    {
        return $this->scoreManager;
    }

    /**
     * @return TeamManagerInterface
     */
    private function getTeamManager(): TeamManagerInterface
    {
        return $this->teamManager;
    }
}
