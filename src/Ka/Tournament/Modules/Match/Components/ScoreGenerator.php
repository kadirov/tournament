<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Match\Components;

use Ka\Tournament\Modules\Common\Interfaces\Match\Models\ScoreInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\ScoreGeneratorInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\ScoreManagerInterface;
use Ka\Tournament\Modules\Match\Models\Score;

class ScoreGenerator implements ScoreGeneratorInterface
{
    /**
     * @var ScoreManagerInterface
     */
    private $scoreManager;

    /**
     * ScoreGenerator constructor.
     * @param ScoreManagerInterface $scoreManager
     */
    public function __construct(ScoreManagerInterface $scoreManager)
    {
        $this->scoreManager = $scoreManager;
    }

    /**
     * Generate score where first team is won
     *
     * @param int $minScore
     * @param int $maxScore
     * @return ScoreInterface
     */
    public function winFirstTeam(int $minScore, int $maxScore): ScoreInterface
    {
        $score = new Score();

        $score->setFirstTeamScore($this->generateWinScore($minScore, $maxScore));
        $score->setSecondTeamScore($this->generateLoseScore($minScore, $score->getFirstTeamScore()));

        $this->getScoreManager()->save($score);

        return $score;
    }

    /**
     * Generate score where second team is won
     *
     * @param int $minScore
     * @param int $maxScore
     * @return ScoreInterface
     */
    public function winSecondTeam(int $minScore, int $maxScore): ScoreInterface
    {
        $score = new Score();

        $score->setSecondTeamScore($this->generateWinScore($minScore, $maxScore));
        $score->setFirstTeamScore($this->generateLoseScore($minScore, $score->getSecondTeamScore()));

        $this->getScoreManager()->save($score);

        return $score;
    }

    /**
     * @param int $minScore
     * @param int $maxScore
     * @return ScoreInterface
     */
    public function draw(int $minScore, int $maxScore): ScoreInterface
    {
        $score = new Score();

        $score->setFirstTeamScore($this->generateWinScore($minScore, $maxScore));
        $score->setSecondTeamScore($score->getFirstTeamScore());

        $this->getScoreManager()->save($score);

        return $score;
    }

    /**
     * @param int $minScore
     * @param int $maxScore
     * @return int
     */
    private function generateWinScore(int $minScore, int $maxScore): int
    {
        return random_int($minScore + 1, $maxScore);
    }

    /**
     * @param int $minScore
     * @param int $winScore
     * @return int
     */
    private function generateLoseScore(int $minScore, int $winScore): int
    {
        return random_int($minScore, $winScore - 1);
    }

    /**
     * @return ScoreManagerInterface
     */
    private function getScoreManager(): ScoreManagerInterface
    {
        return $this->scoreManager;
    }
}
