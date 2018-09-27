<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Match\Components;

use Ka\Tournament\Modules\Common\Interfaces\Match\Models\ScoreInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\ScoreManagerInterface;
use Ka\Tournament\Modules\Match\Models\Score;

class ScoreManager implements ScoreManagerInterface
{
    /**
     * @param ScoreInterface|Score $score
     * @return bool
     */
    public function save(ScoreInterface $score): bool
    {
        return $score->save();
    }

    /**
     * @return void
     */
    public function truncate(): void
    {
        Score::deleteAll();
    }
}
