<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Match\Components\MatchBuilderStrategies;

use Ka\Tournament\Modules\Common\Interfaces\Match\MatchResultBuilderStrategy;
use Ka\Tournament\Modules\Match\Components\MatchBuilderStrategies\Traits\IsDrawAllowedTrait;
use Ka\Tournament\Modules\Match\Components\MatchBuilderStrategies\Traits\PenaltiesTrait;

class AdditionalTimesStrategy implements MatchResultBuilderStrategy
{
    use IsDrawAllowedTrait;
    use PenaltiesTrait;

    /**
     * Get minimum score that might been in matches
     *
     * @return int
     */
    public function getMinScore(): int
    {
        return 0;
    }

    /**
     * Get maximum score that might been in matches
     *
     * @return int
     */
    public function getMaxScore(): int
    {
        return 1;
    }

    /**
     * @return MatchResultBuilderStrategy|null
     */
    public function getAdditionalTimesStrategy(): ?MatchResultBuilderStrategy
    {
        return $this;
    }
}
