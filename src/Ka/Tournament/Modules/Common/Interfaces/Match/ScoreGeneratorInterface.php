<?php
declare(strict_types=1);

namespace Ka\Tournament\Modules\Common\Interfaces\Match;

use Ka\Tournament\Modules\Common\Interfaces\Match\Models\ScoreInterface;

/**
 * Interface ScoreGeneratorInterface
 * @package Ka\Tournament\Modules\Common\Interfaces\Match
 */
interface ScoreGeneratorInterface
{
    /**
     * @return ScoreInterface
     */
    public function draw(): ScoreInterface;

    /**
     * @return ScoreInterface
     */
    public function winFirstTeam(): ScoreInterface;

    /**
     * @return ScoreInterface
     */
    public function winSecondTeam(): ScoreInterface;
}
