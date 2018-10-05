<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Match\Components\MatchBuilderStrategies;

use Ka\Tournament\Modules\Common\Interfaces\Match\MatchResultBuilderStrategy;

class GroupStrategy implements MatchResultBuilderStrategy
{
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
        return 5;
    }

    /**
     * Can match end with draw result?
     *
     * @return bool
     */
    public function isDrawAllowed(): bool
    {
        return true;
    }

    /**
     * @return MatchResultBuilderStrategy|null
     */
    public function getAdditionalTimesStrategy(): ?MatchResultBuilderStrategy
    {
        return null;
    }

    /**
     * @return MatchResultBuilderStrategy|null
     */
    public function getPenaltiesStrategy(): ?MatchResultBuilderStrategy
    {
        return null;
    }
}
