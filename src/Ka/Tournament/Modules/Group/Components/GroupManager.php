<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Group\Components;

use Ka\Tournament\Modules\Common\Interfaces\Group\GroupManagerInterface;
use Ka\Tournament\Modules\Common\Interfaces\Group\Models\GroupInterface;
use Ka\Tournament\Modules\Common\Interfaces\Group\Models\GroupResultInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\MatchResultManagerInterface;
use Ka\Tournament\Modules\Group\Models\Group;
use Ka\Tournament\Modules\Group\Models\GroupResult;

/**
 * Class GroupManager
 *
 * @package Ka\Tournament\Modules\Group\Components
 */
class GroupManager implements GroupManagerInterface
{
    /**
     * @var MatchResultManagerInterface
     */
    private $matchResultManager;

    /**
     * GroupManager constructor.
     * @param MatchResultManagerInterface $matchResultManager
     */
    public function __construct(MatchResultManagerInterface $matchResultManager)
    {
        $this->matchResultManager = $matchResultManager;
    }

    /**
     * @return GroupInterface[]|array
     */
    public function getAll(): array
    {
        return Group::find()->all();
    }

    /**
     * Get group results for current time
     *
     * @param GroupInterface $group
     * @return GroupResultInterface[]|[]
     */
    public function getGroupResults(GroupInterface $group): array
    {
        /**
         * @var GroupResult[] $result
         */
        $result = [];

        foreach ($group->getTeams() as $team) {
            $matchResults = $this->getMatchResultManager()->getTeamMatchesInGroup($team, $group);

            $gr = new GroupResult();
            $gr->setGroup($group);
            $gr->setTeam($team);
            $gr->setGamesPlayed(\count($matchResults));

            foreach ($matchResults as $matchResult) {
                if ($matchResult->isDraw()) {
                    $gr->setGamesDrawn($gr->getGamesDrawn() + 1);
                    $gr->setPoint($gr->getPoint() + 1);
                    continue;
                }

                if ($matchResult->isFirstTeamWon()) {
                    if ($matchResult->getTeam1()->getId() === $team->getId()) {
                        $gr->setGamesWon($gr->getGamesWon() + 1);
                        $gr->setPoint($gr->getPoint() + 3);
                        $gr->setGoalDifference(
                            $gr->getGoalDifference() +
                            $matchResult->getFinalScore()->getFirstTeamScore() -
                            $matchResult->getFinalScore()->getSecondTeamScore()
                        );
                        continue;
                    }

                    $gr->setGamesLost($gr->getGamesLost() + 1);
                    $gr->setGoalDifference(
                        $gr->getGoalDifference() +
                        $matchResult->getSecondTimeScore()->getSecondTeamScore() -
                        $matchResult->getFinalScore()->getFirstTeamScore()
                    );

                    continue;
                }

                if ($matchResult->getTeam2()->getId() === $team->getId()) {
                    $gr->setGamesWon($gr->getGamesWon() + 1);
                    $gr->setPoint($gr->getPoint() + 3);
                    $gr->setGoalDifference(
                        $gr->getGoalDifference() +
                        $matchResult->getFinalScore()->getSecondTeamScore() -
                        $matchResult->getFinalScore()->getFirstTeamScore()
                    );
                    continue;
                }

                $gr->setGamesLost($gr->getGamesLost() + 1);
                $gr->setGoalDifference(
                    $gr->getGoalDifference() +
                    $matchResult->getFinalScore()->getFirstTeamScore() -
                    $matchResult->getFinalScore()->getSecondTeamScore()
                );
            }

            $result[] = $gr;
        }

        \usort($result, function (GroupResult $a, GroupResult $b) {
            if ($a->getPoint() < $b->getPoint()) {
                return 1;
            }

            if ($a->getPoint() > $b->getPoint()) {
                return -1;
            }

            // if teams have equal points, we'll check goal difference each of team
            if ($a->getGoalDifference() < $b->getGoalDifference()) {
                return 1;
            }

            if ($a->getGoalDifference() > $b->getGoalDifference()) {
                return -1;
            }

            // todo:
            // if goal difference are equals too, we should check match when teams
            // play with each other, but it we leave in the feature

            return 0;
        });

        foreach ($result as $key => $value) {
            $value->setPosition($key + 1);
        }

        return $result;
    }

    /**
     * @param GroupInterface|Group $group
     * @return bool
     */
    public function save(GroupInterface $group): bool
    {
        return $group->save();
    }

    /**
     * @return MatchResultManagerInterface
     */
    private function getMatchResultManager(): MatchResultManagerInterface
    {
        return $this->matchResultManager;
    }
}
