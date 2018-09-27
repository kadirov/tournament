<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Match\Components;

use Ka\Tournament\Modules\Common\Interfaces\Match\Models\ScoreInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\ScoreGeneratorInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\ScoreManagerInterface;
use Ka\Tournament\Modules\Match\Models\Score;

class ScoreGenerator implements ScoreGeneratorInterface
{
    /**
     * Max score
     */
    private const MAX_SCORE = 5;

    /**
     * @var ScoreManagerInterface
     */
    private $scoreManager;

    /**
     * ScoreGenerator constructor.
     * @param ScoreManagerInterface $scoreManager
     */
    public function __construct
    (
        ScoreManagerInterface $scoreManager
    )
    {
        $this->scoreManager = $scoreManager;
    }

    /**
     * Generate score where first team is won
     *
     * @return ScoreInterface
     */
    public function winFirstTeam(): ScoreInterface
    {
        $score = new Score();

        $score->setFirstTeamScore($this->generateWinScore());
        $score->setSecondTeamScore($this->generateLoseScore($score->getFirstTeamScore()));

        $this->getScoreManager()->save($score);

        return $score;
    }

    /**
     * Generate score where second team is won
     *
     * @return ScoreInterface
     */
    public function winSecondTeam(): ScoreInterface
    {
        $score = new Score();

        $score->setSecondTeamScore($this->generateWinScore());
        $score->setFirstTeamScore($this->generateLoseScore($score->getSecondTeamScore()));

        $this->getScoreManager()->save($score);

        return $score;
    }

    /**
     * @return ScoreInterface
     */
    public function draw(): ScoreInterface
    {
        $score = new Score();


        $score->setFirstTeamScore($this->generateWinScore());
        $score->setSecondTeamScore($score->getFirstTeamScore());

        $this->getScoreManager()->save($score);

        return $score;
    }

    /**
     * @return int
     */
    private function generateWinScore(): int
    {
        return random_int(1, self::MAX_SCORE);
    }

    /**
     * @param int $winScore
     * @return int
     */
    private function generateLoseScore(int $winScore): int
    {
        return random_int(0, $winScore - 1);
    }

    /**
     * @return ScoreManagerInterface
     */
    private function getScoreManager(): ScoreManagerInterface
    {
        return $this->scoreManager;
    }
}
