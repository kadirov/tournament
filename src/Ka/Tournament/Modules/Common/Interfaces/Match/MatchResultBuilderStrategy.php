<?php

namespace Ka\Tournament\Modules\Common\Interfaces\Match;

interface MatchResultBuilderStrategy
{
    /**
     * Get minimum score that might been in matches
     *
     * @return int
     */
    public function getMinScore(): int;

    /**
     * Get maximum score that might been in matches
     *
     * @return int
     */
    public function getMaxScore(): int;

    /**
     * Can match end with draw result?
     *
     * @return bool
     */
    public function isDrawAllowed(): bool;

    /**
     * @return MatchResultBuilderStrategy|null
     */
    public function getAdditionalTimesStrategy(): ?MatchResultBuilderStrategy;

    /**
     * @return MatchResultBuilderStrategy|null
     */
    public function getPenaltiesStrategy(): ?MatchResultBuilderStrategy;
}
