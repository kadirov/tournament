<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Group\Components;

use Ka\Tournament\Modules\Common\Constants\TournamentState;
use Ka\Tournament\Modules\Common\Interfaces\Group\GroupGamesInterface;
use Ka\Tournament\Modules\Common\Interfaces\Group\GroupManagerInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\MatchResultBuilderInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\MatchResultBuilderStrategy;
use Ka\Tournament\Modules\Common\Interfaces\Match\MatchResultManagerInterface;
use Ka\Tournament\Modules\Common\Interfaces\Team\Models\TeamInterface;
use Ka\Tournament\Modules\Common\Interfaces\Tournament\TournamentStateInterface;
use Ka\Tournament\Modules\Match\Components\MatchBuilderStrategies\GroupStrategy;

class GroupGames implements GroupGamesInterface
{
    /**
     * @var MatchResultBuilderInterface
     */
    private $matchResultBuilder;

    /**
     * @var GroupManagerInterface
     */
    private $groupManager;

    /**
     * @var MatchResultManagerInterface
     */
    private $matchResultManager;

    /**
     * @var GroupStrategy
     */
    private $strategy;

    /**
     * GroupGames constructor.
     * @param MatchResultBuilderInterface $matchResultBuilder
     * @param MatchResultManagerInterface $matchResultManager
     * @param GroupManagerInterface $groupManager
     */
    public function __construct
    (
        MatchResultBuilderInterface $matchResultBuilder,
        MatchResultManagerInterface $matchResultManager,
        GroupManagerInterface $groupManager
    ) {
        $this->matchResultBuilder = $matchResultBuilder;
        $this->groupManager = $groupManager;
        $this->matchResultManager = $matchResultManager;
    }

    /**
     * Play one round of group
     * @param TournamentStateInterface $tournamentState
     */
    public function playRound(TournamentStateInterface $tournamentState): void
    {
        foreach ($this->getGroupManager()->getAll() as $group) {
            $teams = $group->getTeams();

            switch ($tournamentState->getValue()) {
                case TournamentState::GROUP_ROUND_1:
                    $this->play($teams[0], $teams[1]);
                    $this->play($teams[2], $teams[3]);
                    break;

                case TournamentState::GROUP_ROUND_2:
                    $this->play($teams[1], $teams[2]);
                    $this->play($teams[3], $teams[0]);
                    break;

                case TournamentState::GROUP_ROUND_3:
                    $this->play($teams[0], $teams[2]);
                    $this->play($teams[3], $teams[1]);
                    break;

                default:
                    throw new \LogicException('It is not group stage: ' . $tournamentState->getValue());
            }
        }
    }

    /**
     * @return MatchResultBuilderStrategy
     */
    private function getStrategy(): MatchResultBuilderStrategy
    {
        if ($this->strategy === null) {
            $this->strategy = new GroupStrategy();
        }

        return $this->strategy;
    }

    /**
     * @param TeamInterface $team1
     * @param TeamInterface $team2
     */
    private function play(TeamInterface $team1, TeamInterface $team2): void
    {
        $matchResult = $this->getMatchResultBuilder()->build($team1, $team2, $this->getStrategy());
        $this->getMatchResultManager()->save($matchResult);
    }

    /**
     * @return MatchResultManagerInterface
     */
    private function getMatchResultManager(): MatchResultManagerInterface
    {
        return $this->matchResultManager;
    }

    /**
     * @return GroupManagerInterface
     */
    private function getGroupManager(): GroupManagerInterface
    {
        return $this->groupManager;
    }

    /**
     * @return MatchResultBuilderInterface
     */
    private function getMatchResultBuilder(): MatchResultBuilderInterface
    {
        return $this->matchResultBuilder;
    }
}
