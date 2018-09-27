<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Common\Interfaces\Group;

/**
 * Interface uses to define teams for groups
 *
 * @package Ka\Tournament\Modules\Common\Interfaces
 */
interface DrawingGroupInterface
{
    /**
     * Draw.
     *
     * Define Teams for Groups
     */
    public function draw(): void;
}
