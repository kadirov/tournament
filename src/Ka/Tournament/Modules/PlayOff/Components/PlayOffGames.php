<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\PlayOff\Components;

use Ka\Tournament\Modules\Common\Constants\PlayOffLabel;
use Ka\Tournament\Modules\Common\Constants\TournamentState;
use Ka\Tournament\Modules\Common\Interfaces\Group\GroupManagerInterface;
use Ka\Tournament\Modules\Common\Interfaces\Group\Models\GroupInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\Models\MatchResultInterface;
use Ka\Tournament\Modules\Common\Interfaces\PlayOff\Models\PlayOffInterface;
use Ka\Tournament\Modules\Common\Interfaces\PlayOff\PlayOffGamesInterface;
use Ka\Tournament\Modules\Common\Interfaces\Team\Models\TeamInterface;
use Ka\Tournament\Modules\Common\Interfaces\Team\TeamManagerInterface;
use Ka\Tournament\Modules\Common\Interfaces\Tournament\TournamentStateInterface;
use Ka\Tournament\Modules\Match\Components\MatchResultBuilder;
use Ka\Tournament\Modules\Match\Components\MatchResultManager;
use Ka\Tournament\Modules\PlayOff\Models\PlayOff;

class PlayOffGames implements PlayOffGamesInterface
{
    /**
     * @var GroupManagerInterface
     */
    private $groupManager;

    /**
     * @var MatchResultBuilder
     */
    private $matchResultBuilder;

    /**
     * @var MatchResultManager
     */
    private $matchResultManager;

    /**
     * @var TeamManagerInterface
     */
    private $teamManager;

    /**
     * PlayOffGames constructor.
     * @param GroupManagerInterface $groupManager
     * @param MatchResultBuilder $matchResultBuilder
     * @param TeamManagerInterface $teamManager
     * @param MatchResultManager $matchResultManager
     */
    public function __construct
    (
        GroupManagerInterface $groupManager,
        MatchResultBuilder $matchResultBuilder,
        TeamManagerInterface $teamManager,
        MatchResultManager $matchResultManager
    ) {
        $this->groupManager = $groupManager;
        $this->matchResultBuilder = $matchResultBuilder;
        $this->matchResultManager = $matchResultManager;
        $this->teamManager = $teamManager;
    }

    /**
     * Play one round of group
     * @param TournamentStateInterface $tournamentState
     */
    public function playRound(TournamentStateInterface $tournamentState): void
    {
        switch ($tournamentState->getValue()) {
            case TournamentState::PLAYOFF_PREPARE:
                foreach ($this->getGroupManager()->getAll() as $group) {
                    $this->prepareRound16($group);
                }

                break;

            case TournamentState::PLAYOFF_16:
                ;
                foreach (PlayOff::find()->byLabels($this->getRound16Labels())->all() as $playOff) {
                    $teams = $playOff->getTeams();

                    switch ($playOff->getLabel()) {
                        case PlayOffLabel::A1B2:
                        case PlayOffLabel::C1D2:
                            $label = PlayOffLabel::QUARTER_FINAL_ABCD1;
                            break;

                        case PlayOffLabel::A2B1:
                        case PlayOffLabel::C2D1:
                            $label = PlayOffLabel::QUARTER_FINAL_ABCD2;
                            break;

                        case PlayOffLabel::E1F2:
                        case PlayOffLabel::G1H2:
                            $label = PlayOffLabel::QUARTER_FINAL_EFGH1;
                            break;

                        case PlayOffLabel::E2F1:
                        case PlayOffLabel::G2H1:
                            $label = PlayOffLabel::QUARTER_FINAL_EFGH2;
                            break;
                        default:
                            throw new \LogicException('Unknown PlayOff pair');
                    }

                    $this->playAndAddWinnerToPlayOff($teams, $label);
                }
                break;

            case TournamentState::PLAYOFF_QUARTER_FINAL:
                foreach (PlayOff::find()->byLabels($this->getQuarterLabels())->all() as $playOff) {
                    $teams = $playOff->getTeams();

                    switch ($playOff->getLabel()) {
                        case PlayOffLabel::QUARTER_FINAL_ABCD1:
                        case PlayOffLabel::QUARTER_FINAL_EFGH1:
                            $label = PlayOffLabel::SEMI_FINAL_1;
                            break;

                        case PlayOffLabel::QUARTER_FINAL_ABCD2:
                        case PlayOffLabel::QUARTER_FINAL_EFGH2:
                            $label = PlayOffLabel::SEMI_FINAL_2;
                            break;

                        default:
                            throw new \LogicException('Unknown PlayOff pair');
                    }

                    $this->playAndAddWinnerToPlayOff($teams, $label);
                }
                break;

            case TournamentState::PLAYOFF_SEMI_FINAL:
                foreach (PlayOff::find()->byLabels($this->getSemiFinalLabels())->all() as $playOff) {
                    $teams = $playOff->getTeams();

                    if ($this->play($teams[0], $teams[1])->isFirstTeamWon()) {
                        $this->addTeamByLabel($teams[0], PlayOffLabel::FINAL);
                        $this->addTeamByLabel($teams[1], PlayOffLabel::FOR_THIRD_PLACE);
                        continue;
                    }

                    $this->addTeamByLabel($teams[0], PlayOffLabel::FOR_THIRD_PLACE);
                    $this->addTeamByLabel($teams[1], PlayOffLabel::FINAL);
                }
                break;

            case TournamentState::PLAYOFF_FOR_THIRD_PLACE:
                $teams = $this->findPlayOff(PlayOffLabel::FOR_THIRD_PLACE)->getTeams();
                $this->play($teams[0], $teams[1]);
                break;

            case TournamentState::PLAYOFF_FINAL:
                $teams = $this->findPlayOff(PlayOffLabel::FINAL)->getTeams();
                $this->play($teams[0], $teams[1]);
                break;

            default:
                throw new \LogicException('It is not playOff stage: ' . $tournamentState->getValue());
        }
    }

    /**
     * @param TeamInterface $team1
     * @param TeamInterface $team2
     * @return MatchResultInterface
     */
    private function play(TeamInterface $team1, TeamInterface $team2): MatchResultInterface
    {
        $matchResult = $this->getMatchResultBuilder()->build($team1, $team2, false);
        $this->getMatchResultManager()->save($matchResult);
        return $matchResult;
    }

    private function prepareRound16(GroupInterface $group): void
    {
        foreach ($this->getGroupManager()->getGroupResults($group) as $gr) {
            if ($gr->getPosition() > 2) {
                continue;
            }

            switch ($gr->getGroup()->getLabel()) {
                case 'A':
                    $this->addTeamByLabel(
                        $gr->getTeam(),
                        $gr->getPosition() === 1 ? PlayOffLabel::A1B2 : PlayOffLabel::A2B1
                    );
                    break;

                case 'B':
                    $this->addTeamByLabel(
                        $gr->getTeam(),
                        $gr->getPosition() === 1 ? PlayOffLabel::A2B1 : PlayOffLabel::A1B2
                    );
                    break;

                case 'C':
                    $this->addTeamByLabel(
                        $gr->getTeam(),
                        $gr->getPosition() === 1 ? PlayOffLabel::C1D2 : PlayOffLabel::C2D1
                    );
                    break;

                case 'D':
                    $this->addTeamByLabel(
                        $gr->getTeam(),
                        $gr->getPosition() === 1 ? PlayOffLabel::C2D1 : PlayOffLabel::C1D2
                    );
                    break;

                case 'E':
                    $this->addTeamByLabel(
                        $gr->getTeam(),
                        $gr->getPosition() === 1 ? PlayOffLabel::E1F2 : PlayOffLabel::E2F1
                    );
                    break;

                case 'F':
                    $this->addTeamByLabel(
                        $gr->getTeam(),
                        $gr->getPosition() === 1 ? PlayOffLabel::E2F1 : PlayOffLabel::E1F2
                    );
                    break;

                case 'G':
                    $this->addTeamByLabel(
                        $gr->getTeam(),
                        $gr->getPosition() === 1 ? PlayOffLabel::G1H2 : PlayOffLabel::G2H1
                    );
                    break;

                case 'H':
                    $this->addTeamByLabel(
                        $gr->getTeam(),
                        $gr->getPosition() === 1 ? PlayOffLabel::G2H1 : PlayOffLabel::G1H2
                    );
                    break;
            }
        }
    }

    /**
     * @param string $label A constant of {@see PlayOffLabel}
     * @see PlayOffLabel
     * @return PlayOffInterface
     */
    private function findPlayOff(string $label): PlayOffInterface
    {
        $playOff = PlayOff::find()->byLabel($label)->one();

        if ($playOff === null) {
            throw new \RuntimeException('PlayOff entity is not found. Do you have run migrations?');
        }

        return $playOff;
    }

    /**
     * @param array $teams
     * @param string $label
     * @return void
     */
    private function playAndAddWinnerToPlayOff(array $teams, string $label): void
    {
        if ($this->play($teams[0], $teams[1])->isFirstTeamWon()) {
            $this->addTeamByLabel($teams[0], $label);

        } else {
            $this->addTeamByLabel($teams[1], $label);
        }
    }

    /**
     * @return array
     */
    private function getRound16Labels(): array
    {
        return [
            PlayOffLabel::A1B2,
            PlayOffLabel::A2B1,
            PlayOffLabel::C1D2,
            PlayOffLabel::C2D1,
            PlayOffLabel::E1F2,
            PlayOffLabel::E2F1,
            PlayOffLabel::G1H2,
            PlayOffLabel::G2H1,
        ];
    }

    /**
     * @return array
     */
    private function getQuarterLabels(): array
    {
        return [
            PlayOffLabel::QUARTER_FINAL_ABCD1,
            PlayOffLabel::QUARTER_FINAL_ABCD2,
            PlayOffLabel::QUARTER_FINAL_EFGH1,
            PlayOffLabel::QUARTER_FINAL_EFGH2,
        ];
    }

    /**
     * @return array
     */
    private function getSemiFinalLabels(): array
    {
        return [
            PlayOffLabel::SEMI_FINAL_1,
            PlayOffLabel::SEMI_FINAL_2,
        ];
    }

    /**
     * @param TeamInterface $team
     * @param string $label
     */
    private function addTeamByLabel(TeamInterface $team, string $label): void
    {
        $team->setPlayOff($this->findPlayOff($label));
        $this->getTeamManager()->save($team);
    }

    /**
     * @return TeamManagerInterface
     */
    private function getTeamManager(): TeamManagerInterface
    {
        return $this->teamManager;
    }

    /**
     * @return MatchResultBuilder
     */
    private function getMatchResultBuilder(): MatchResultBuilder
    {
        return $this->matchResultBuilder;
    }

    /**
     * @return GroupManagerInterface
     */
    private function getGroupManager(): GroupManagerInterface
    {
        return $this->groupManager;
    }

    /**
     * @return MatchResultManager
     */
    private function getMatchResultManager(): MatchResultManager
    {
        return $this->matchResultManager;
    }
}
