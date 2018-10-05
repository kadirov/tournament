<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Match\Components\MatchBuilderStrategies\Traits;

trait IsDrawAllowedTrait
{
    /**
     * Can match end with draw result?
     *
     * @return bool
     */
    public function isDrawAllowed(): bool
    {
        return false;
    }
}
