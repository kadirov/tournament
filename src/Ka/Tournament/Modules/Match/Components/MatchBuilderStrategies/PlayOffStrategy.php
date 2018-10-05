<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Match\Components\MatchBuilderStrategies;

use Ka\Tournament\Modules\Common\Interfaces\Match\MatchResultBuilderStrategy;
use Ka\Tournament\Modules\Match\Components\MatchBuilderStrategies\Traits\AdditionalTimesTrait;
use Ka\Tournament\Modules\Match\Components\MatchBuilderStrategies\Traits\IsDrawAllowedTrait;
use Ka\Tournament\Modules\Match\Components\MatchBuilderStrategies\Traits\PenaltiesTrait;

class PlayOffStrategy implements MatchResultBuilderStrategy
{
    use AdditionalTimesTrait;
    use IsDrawAllowedTrait;
    use PenaltiesTrait;

    /**
     * PlayOffStrategy constructor.
     */
    public function __construct()
    {
        $this->additionalTimes = new AdditionalTimesStrategy();
    }

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
        return 4;
    }
}
