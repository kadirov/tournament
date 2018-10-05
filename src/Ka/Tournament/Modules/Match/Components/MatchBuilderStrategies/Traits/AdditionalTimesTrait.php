<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Match\Components\MatchBuilderStrategies\Traits;

use Ka\Tournament\Modules\Common\Interfaces\Match\MatchResultBuilderStrategy;
use Ka\Tournament\Modules\Match\Components\MatchBuilderStrategies\AdditionalTimesStrategy;

trait AdditionalTimesTrait
{
    /**
     * @var AdditionalTimesStrategy
     */
    private $additionalTimes;

    /**
     * @return MatchResultBuilderStrategy|null
     */
    public function getAdditionalTimesStrategy(): ?MatchResultBuilderStrategy
    {
        if ($this->additionalTimes === null) {
            $this->additionalTimes = new AdditionalTimesStrategy();
        }

        return $this->additionalTimes;
    }
}
