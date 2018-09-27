<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Common\Interfaces\Match;

use Ka\Tournament\Modules\Common\Interfaces\Match\Models\ScoreInterface;

interface ScoreManagerInterface
{
    /**
     * @param ScoreInterface $score
     * @return bool
     */
    public function save(ScoreInterface $score): bool;

    /**
     * @return void
     */
    public function truncate(): void;
}
