<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Common\Interfaces\Group;

use Ka\Tournament\Modules\Common\Interfaces\Group\Models\GroupInterface;
use Ka\Tournament\Modules\Common\Interfaces\Group\Models\GroupResultInterface;

interface GroupManagerInterface
{
    /**
     * @return GroupInterface[]|array
     */
    public function getAll(): array;

    /**
     * @param GroupInterface $group
     * @return bool
     */
    public function save(GroupInterface $group): bool;

    /**
     * Get group results for current time
     *
     * @param GroupInterface $group
     * @return GroupResultInterface[]|[]
     */
    public function getGroupResults(GroupInterface $group): array;
}
