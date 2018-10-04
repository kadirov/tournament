<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Common\Interfaces\Group;

use Ka\Tournament\Modules\Common\Interfaces\Group\Models\GroupInterface;
use Ka\Tournament\Modules\Common\Interfaces\Group\Models\GroupResultInterface;

/**
 * Interface GroupManagerInterface
 * @package Ka\Tournament\Modules\Common\Interfaces\Group
 */
interface GroupManagerInterface
{
    /**
     * @return GroupInterface[]|array
     */
    public function getAll(): array;

    /**
     * Get group results for current time
     *
     * @param GroupInterface $group
     * @return GroupResultInterface[]|[]
     */
    public function getGroupResults(GroupInterface $group): array;

    /**
     * @param GroupInterface $group
     * @return bool
     */
    public function save(GroupInterface $group): bool;
}
