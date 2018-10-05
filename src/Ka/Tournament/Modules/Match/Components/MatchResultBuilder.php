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
            return $this->doFirstTeamWin($matchResult, $strategy);
        }

        if ($power1 < $power2) {
            return $this->doSecondTeamWin($matchResult, $strategy);
        }

        $drawScore = $this->getScoreGenerator()->draw($strategy->getMinScore(), $strategy->getMaxScore());

        $matchResult->setSecondTimeScore($drawScore);

        if ($strategy->isDrawAllowed()) {
            $matchResult->setFinalScore($drawScore);
            return $matchResult;
        }

        return $this->doAdditionalTimesAndPenalties($matchResult, $strategy);
    }

    /**
     * @param MatchResultInterface|MatchResult $matchResult
     * @param MatchResultBuilderStrategy $strategy
     * @return MatchResult
     */
    private function doAdditionalTimesAndPenalties(
        MatchResultInterface $matchResult,
        MatchResultBuilderStrategy $strategy
    ): MatchResultInterface {
        $power1 = $this->calcPower($matchResult->getTeam1());
        $power2 = $this->calcPower($matchResult->getTeam2());

        if ($power1 > $power2) {
            $score = $this->getScoreGenerator()->winFirstTeam(
                $strategy->getAdditionalTimesStrategy()->getMinScore(),
                $strategy->getAdditionalTimesStrategy()->getMaxScore()
            );
        } elseif ($power1 < $power2) {
            $score = $this->getScoreGenerator()->winSecondTeam(
                $strategy->getAdditionalTimesStrategy()->getMinScore(),
                $strategy->getAdditionalTimesStrategy()->getMaxScore()
            );
        } else {
            $score = $this->getScoreGenerator()->draw(
                $strategy->getAdditionalTimesStrategy()->getMinScore(),
                $strategy->getAdditionalTimesStrategy()->getMaxScore()
            );
        }

        $matchResult->setAdditionalScore($score);

        $finalScore = new Score();

        $finalScore->setFirstTeamScore(
            $this->sumOfFirstTeamScores($matchResult->getSecondTimeScore(), $score)
        );

        $finalScore->setSecondTeamScore(
            $this->sumOfSecondTeamScores($matchResult->getSecondTimeScore(), $score)
        );

        $this->getScoreManager()->save($finalScore);

        $matchResult->setFinalScore($finalScore);

        if (!$matchResult->isDraw()) {
            return $matchResult;
        }

        return $this->doPenalties($matchResult, $strategy);
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
            $score = $this->getScoreGenerator()->winFirstTeam(
                $strategy->getPenaltiesStrategy()->getMinScore(),
                $strategy->getPenaltiesStrategy()->getMaxScore()
            );
        } else {
            $score = $this->getScoreGenerator()->winSecondTeam(
                $strategy->getPenaltiesStrategy()->getMinScore(),
                $strategy->getPenaltiesStrategy()->getMaxScore()
            );
        }

        $matchResult->setPenaltiesScore($score);

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
     * @param MatchResultBuilderStrategy $strategy
     * @return MatchResultInterface
     */
    private function doFirstTeamWin(
        MatchResultInterface $matchResult,
        MatchResultBuilderStrategy $strategy
    ): MatchResultInterface {
        $score = $this->getScoreGenerator()->winFirstTeam($strategy->getMinScore(), $strategy->getMaxScore());
        $matchResult->setSecondTimeScore($score);
        $matchResult->setFinalScore($score);
        return $matchResult;
    }

    /**
     * @param MatchResultInterface|MatchResult $matchResult
     * @param MatchResultBuilderStrategy $strategy
     * @return MatchResultInterface
     */
    private function doSecondTeamWin(
        MatchResultInterface $matchResult,
        MatchResultBuilderStrategy $strategy
    ): MatchResultInterface {
        $score = $this->getScoreGenerator()->winSecondTeam($strategy->getMinScore(), $strategy->getMaxScore());
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

    private function calcPower(TeamInterface $team): int
    {
        return $team->getPower() + $this->fortune();
    }
}
