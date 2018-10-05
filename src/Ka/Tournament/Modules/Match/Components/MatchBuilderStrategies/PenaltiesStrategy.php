<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Match\Components\MatchBuilderStrategies;

use Ka\Tournament\Modules\Common\Interfaces\Match\MatchResultBuilderStrategy;
use Ka\Tournament\Modules\Match\Components\MatchBuilderStrategies\Traits\AdditionalTimesTrait;
use Ka\Tournament\Modules\Match\Components\MatchBuilderStrategies\Traits\IsDrawAllowedTrait;

class PenaltiesStrategy implements MatchResultBuilderStrategy
{
    use IsDrawAllowedTrait;
    use AdditionalTimesTrait;

    /**
     * Get minimum score that might been in matches
     *
     * @return int
     */
    public function getMinScore(): int
    {
        return 4;
    }

    /**
     * Get maximum score that might been in matches
     *
     * @return int
     */
    public function getMaxScore(): int
    {
        return 5;
    }

    /**
     * @return MatchResultBuilderStrategy|null
     */
    public function getPenaltiesStrategy(): ?MatchResultBuilderStrategy
    {
        return $this;
    }
}
