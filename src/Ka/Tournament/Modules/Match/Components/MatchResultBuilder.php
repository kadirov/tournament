<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Match\Components;

use Ka\Tournament\Modules\Common\Interfaces\Match\MatchResultBuilderInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\Models\MatchResultInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\Models\ScoreInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\ScoreGeneratorInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\ScoreManagerInterface;
use Ka\Tournament\Modules\Common\Interfaces\Team\Models\TeamInterface;
use Ka\Tournament\Modules\Match\Models\MatchResult;
use Ka\Tournament\Modules\Match\Models\Score;
use phpDocumentor\Reflection\Types\This;

class MatchResultBuilder implements MatchResultBuilderInterface
{
    /**
     * @var ScoreGeneratorInterface
     */
    private $scoreGenerator;

    /**
     * @var ScoreManagerInterface
     */
    private $scoreManager;

    /**
     * Match constructor.
     * @param ScoreGeneratorInterface $scoreGenerator
     * @param ScoreManagerInterface $scoreManager
     */
    public function __construct
    (
        ScoreGeneratorInterface $scoreGenerator,
        ScoreManagerInterface $scoreManager
    ) {
        $this->scoreGenerator = $scoreGenerator;
        $this->scoreManager = $scoreManager;
    }

    /**
     * Generate and return {@see MatchResultInterface}
     *
     * @see MatchResultInterface
     * @param TeamInterface $team1
     * @param TeamInterface $team2
     * @param bool $drawAllowed
     * @return MatchResultInterface
     */
    public function build(TeamInterface $team1, TeamInterface $team2, bool $drawAllowed = true): MatchResultInterface
    {
        $power1 = $team1->getPower() + $this->fortune();
        $power2 = $team2->getPower() + $this->fortune();

        $matchResult = new MatchResult();
        $matchResult->setTeam1($team1);
        $matchResult->setTeam2($team2);

        if ($power1 > $power2) {
            return $this->doFirstTeamWin($matchResult);
        }

        if ($power1 < $power2) {
            return $this->doSecondTeamWin($matchResult);
        }

        $drawScore = $this->getScoreGenerator()->draw();
        $matchResult->setSecondTimeScore($drawScore);

        if ($drawAllowed) {
            $matchResult->setFinalScore($drawScore);
            return $matchResult;
        }

        return $this->doAdditionalTimesAndPenalties($matchResult);
    }

    /**
     * @todo create scenario pattern for Score and set for additional times 2 goals maximum
     * @param MatchResultInterface|MatchResult $matchResult
     * @return MatchResult
     */
    private function doAdditionalTimesAndPenalties(
        MatchResultInterface $matchResult
    ): MatchResultInterface {
        $additionalTime = $this->build($matchResult->getTeam1(), $matchResult->getTeam2(), true);
        $matchResult->setAdditionalScore($additionalTime->getFinalScore());

        $finalScore = new Score();

        $finalScore->setFirstTeamScore($this->sumOfFirstTeamScores($matchResult->getSecondTimeScore(), $additionalTime->getFinalScore()));
        $finalScore->setSecondTeamScore($this->sumOfSecondTeamScores($matchResult->getSecondTimeScore(), $additionalTime->getFinalScore()));

        $this->getScoreManager()->save($finalScore);

        $matchResult->setFinalScore($finalScore);

        if (!$additionalTime->isDraw()) {
            return $matchResult;
        }

        return $this->doPenalties($matchResult);
    }

    /**
     * @todo create scenario pattern for Score and set for penalties 1 goal different between teams
     * @param MatchResultInterface|MatchResult $matchResult
     * @return MatchResultInterface
     */
    private function doPenalties(MatchResultInterface $matchResult): MatchResultInterface
    {
        while (true) {
            $penalties = $this->build($matchResult->getTeam1(), $matchResult->getTeam2(), false);

            if (!$penalties->isDraw()) {
                break;
            }
        }

        $matchResult->setPenaltiesScore($penalties->getFinalScore());

        return $matchResult;
    }

    /**
     * Method return sum of first team scores
     *
     * @param \Ka\Tournament\Modules\Common\Interfaces\Match\Models\ScoreInterface $score1
     * @param ScoreInterface $score2
     * @return int
     */
    private function sumOfFirstTeamScores(ScoreInterface $score1, ScoreInterface $score2): int
    {
        return $score1->getFirstTeamScore() + $score2->getFirstTeamScore();
    }

    /**
     * Method return sum of second team scores
     *
     * @param \Ka\Tournament\Modules\Common\Interfaces\Match\Models\ScoreInterface $score1
     * @param \Ka\Tournament\Modules\Common\Interfaces\Match\Models\ScoreInterface $score2
     * @return int
     */
    private function sumOfSecondTeamScores(ScoreInterface $score1, ScoreInterface $score2): int
    {
        return $score1->getSecondTeamScore() + $score2->getSecondTeamScore();
    }

    /**
     * @return int
     */
    private function fortune(): int
    {
        return \random_int(0, 3);
    }

    /**
     * @param MatchResultInterface|MatchResult $matchResult
     * @return MatchResultInterface
     */
    private function doFirstTeamWin(MatchResultInterface $matchResult): MatchResultInterface
    {
        $score = $this->getScoreGenerator()->winFirstTeam();
        $matchResult->setSecondTimeScore($score);
        $matchResult->setFinalScore($score);
        return $matchResult;
    }

    /**
     * @param MatchResultInterface|MatchResult $matchResult
     * @return MatchResultInterface
     */
    private function doSecondTeamWin(MatchResultInterface $matchResult): MatchResultInterface
    {
        $score = $this->getScoreGenerator()->winSecondTeam();
        $matchResult->setSecondTimeScore($score);
        $matchResult->setFinalScore($score);
        return $matchResult;

    }

    /**
     * @return ScoreGeneratorInterface
     */
    private function getScoreGenerator(): ScoreGeneratorInterface
    {
        return $this->scoreGenerator;
    }

    /**
     * @return ScoreManagerInterface
     */
    private function getScoreManager(): ScoreManagerInterface
    {
        return $this->scoreManager;
    }
}
