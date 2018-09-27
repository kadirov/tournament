<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Common\Interfaces\PlayOff\Models;

use Ka\Tournament\Modules\Common\Interfaces\Core\IdInterface;
use Ka\Tournament\Modules\Common\Interfaces\Team\Models\TeamInterface;

interface PlayOffInterface extends IdInterface
{
    /**
     * @return string
     */
    public function getLabel(): string;

    /**
     * @return TeamInterface[]|[]
     */
    public function getTeams(): array;
}
