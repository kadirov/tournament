<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Match\Components;

use Ka\Tournament\Modules\Common\Interfaces\Match\MatchResultBuilderInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\MatchResultBuilderStrategy;
use Ka\Tournament\Modules\Common\Interfaces\Match\Models\MatchResultInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\Models\ScoreInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\ScoreGeneratorInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\ScoreManagerInterface;
use Ka\Tournament\Modules\Common\Interfaces\Team\Models\TeamInterface;
use Ka\Tournament\Modules\Match\Models\MatchResult;
use Ka\Tournament\Modules\Match\Models\Score;

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
     * @param MatchResultBuilderStrategy $strategy
     * @return MatchResultInterface
     */
    public function build(
        TeamInterface $team1,
        TeamInterface $team2,
        MatchResultBuilderStrategy $strategy
    ): MatchResultInterface {
        $power1 = $this->calcPower($team1);
        $power2 = $this->calcPower($team2);

        $matchResult = new MatchResult();
        $matchResult->setTeam1($team1);
        $matchResult->setTeam2($team2);

        if ($power1 > $power2) {
            $score = $this->doWinFirstTeam($strategy);
        } elseif ($power1 < $power2) {
            $score = $this->doWinSecondTeam($strategy);
        } else {
            $score = $this->doDraw($strategy);

            if (!$strategy->isDrawAllowed()) {
                $matchResult->setSecondTimeScore($score);
                return $this->playAdditionalTimes($matchResult, $strategy);
            }
        }

        $matchResult->setSecondTimeScore($score);
        $matchResult->setFinalScore($score);
        return $matchResult;
    }

    /**
     * @param MatchResultInterface|MatchResult $matchResult
     * @param MatchResultBuilderStrategy $strategy
     * @return MatchResult
     */
    private function playAdditionalTimes(
        MatchResultInterface $matchResult,
        MatchResultBuilderStrategy $strategy
    ): MatchResultInterface {
        $power1 = $this->calcPower($matchResult->getTeam1());
        $power2 = $this->calcPower($matchResult->getTeam2());

        if ($power1 > $power2) {
            $score = $this->doWinFirstTeam($strategy->getAdditionalTimesStrategy());
        } elseif ($power1 < $power2) {
            $score = $this->doWinSecondTeam($strategy->getAdditionalTimesStrategy());
        } else {
            $score = $this->doDraw($strategy->getAdditionalTimesStrategy());
        }

        $matchResult->setAdditionalScore($score);
        $this->addAdditionalResultToFinalResult($matchResult);

        if (!$matchResult->isDraw()) {
            return $matchResult;
        }

        return $this->doPenalties($matchResult, $strategy);
    }

    /**
     * @param MatchResultInterface|MatchResult $matchResult
     */
    private function addAdditionalResultToFinalResult(MatchResultInterface $matchResult): void
    {
        $finalScore = new Score();

        $finalScore->setFirstTeamScore(
            $this->sumOfFirstTeamScores($matchResult->getSecondTimeScore(), $matchResult->getAdditionalTimesScore())
        );

        $finalScore->setSecondTeamScore(
            $this->sumOfSecondTeamScores($matchResult->getSecondTimeScore(), $matchResult->getAdditionalTimesScore())
        );

        $this->getScoreManager()->save($finalScore);

        $matchResult->setFinalScore($finalScore);
    }

    /**
     * @param MatchResultInterface|MatchResult $matchResult
     * @param MatchResultBuilderStrategy $strategy
     * @return MatchResultInterface
     */
    private function doPenalties(
        MatchResultInterface $matchResult,
        MatchResultBuilderStrategy $strategy
    ): MatchResultInterface {
        if (\random_int(1, 2) === 1) {
            $score = $this->doWinFirstTeam($strategy->getPenaltiesStrategy());
        } else {
            $score = $this->doWinSecondTeam($strategy->getPenaltiesStrategy());
        }

        return $matchResult->setPenaltiesScore($score);
    }

    /**
     * Method return sum of first team scores
     *
     * @param ScoreInterface $score1
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
     * @param ScoreInterface $score1
     * @param ScoreInterface $score2
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

    private function calcPower(TeamInterface $team): int
    {
        return $team->getPower() + $this->fortune();
    }

    /**
     * @param MatchResultBuilderStrategy $strategy
     * @return ScoreInterface
     */
    private function doWinFirstTeam(MatchResultBuilderStrategy $strategy): ScoreInterface
    {
        return $this->getScoreGenerator()->winFirstTeam(
            $strategy->getMinScore(),
            $strategy->getMaxScore()
        );
    }

    /**
     * @param MatchResultBuilderStrategy $strategy
     * @return ScoreInterface
     */
    private function doWinSecondTeam(MatchResultBuilderStrategy $strategy): ScoreInterface
    {
        return $this->getScoreGenerator()->winSecondTeam(
            $strategy->getMinScore(),
            $strategy->getMaxScore()
        );
    }

    /**
     * @param MatchResultBuilderStrategy $strategy
     * @return ScoreInterface
     */
    private function doDraw(MatchResultBuilderStrategy $strategy): ScoreInterface
    {
        return $this->getScoreGenerator()->draw(
            $strategy->getMinScore(),
            $strategy->getMaxScore()
        );
    }
}
