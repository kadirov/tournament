<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Match\Components\MatchBuilderStrategies\Traits;

use Ka\Tournament\Modules\Common\Interfaces\Match\MatchResultBuilderStrategy;
use Ka\Tournament\Modules\Match\Components\MatchBuilderStrategies\PenaltiesStrategy;

trait PenaltiesTrait
{
    /**
     * @var PenaltiesStrategy
     */
    private $penalties;

    /**
     * @return MatchResultBuilderStrategy|null
     */
    public function getPenaltiesStrategy(): ?MatchResultBuilderStrategy
    {
        if ($this->penalties === null) {
            $this->penalties = new PenaltiesStrategy();
        }

        return $this->penalties;
    }
}
