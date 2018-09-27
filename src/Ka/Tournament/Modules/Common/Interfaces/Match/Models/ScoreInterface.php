<?php

namespace Ka\Tournament\Modules\Common\Interfaces\Match\Models;

use Ka\Tournament\Modules\Common\Interfaces\Core\IdInterface;

interface ScoreInterface extends IdInterface
{
    /**
     * Score of first team
     *
     * @return int
     */
    public function getFirstTeamScore(): int;

    /**
     * Score of second team
     *
     * @return int
     */
    public function getSecondTeamScore(): int;
}
