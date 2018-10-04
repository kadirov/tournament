<?php
declare(strict_types=1);

namespace Ka\Tournament\Modules\Common\Interfaces\Team\Models;

use Ka\Tournament\Modules\Common\Interfaces\Core\IdInterface;
use Ka\Tournament\Modules\Common\Interfaces\Group\Models\GroupInterface;
use Ka\Tournament\Modules\Common\Interfaces\PlayOff\Models\PlayOffInterface;

/**
 * Interface TeamInterface
 * @package Ka\Tournament\Modules\Common\Interfaces\Team\Models
 */
interface TeamInterface extends IdInterface
{
    /**
     * Get group of team.
     *
     * @return GroupInterface|null Returns null if team haven't group yet
     */
    public function getGroup(): ?GroupInterface;

    /**
     * Get name of the team.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * @return GroupInterface|null
     */
    public function getPlayOff(): ?PlayOffInterface;

    /**
     * Power of team.
     *
     * It will be taken to result of match.
     *
     * @return int
     */
    public function getPower(): int;

    /**
     * Get group of team.
     *
     * @param GroupInterface $group
     * @return TeamInterface Returns null if team haven't group yet
     */
    public function setGroup(GroupInterface $group): self;

    /**
     * Get name of the team.
     *
     * @param string $name
     * @return TeamInterface
     */
    public function setName(string $name): self;

    /**
     * @param PlayOffInterface $playOff
     * @return TeamInterface
     */
    public function setPlayOff(PlayOffInterface $playOff): self;

    /**
     * Power of team.
     *
     * It will be taken to result of match.
     *
     * @param int $power
     * @return TeamInterface
     */
    public function setPower(int $power): self;
}
