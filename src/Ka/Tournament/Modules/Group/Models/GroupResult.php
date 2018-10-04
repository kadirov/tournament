<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Group\Models;

use Ka\Tournament\Modules\Common\Interfaces\Group\Models\GroupInterface;
use Ka\Tournament\Modules\Common\Interfaces\Group\Models\GroupResultInterface;
use Ka\Tournament\Modules\Common\Interfaces\Team\Models\TeamInterface;

/**
 * Class GroupResult
 *
 * @package Ka\Tournament\Modules\Group\Models
 */
class GroupResult implements GroupResultInterface
{
    /**
     * @var int
     */
    private $gamesDrawn = 0;
    /**
     * @var int
     */
    private $gamesLost = 0;
    /**
     * @var int
     */
    private $gamesPlayed = 0;
    /**
     * @var int
     */
    private $gamesWon = 0;
    /**
     * @var int
     */
    private $goalDifference = 0;
    /**
     * @var GroupInterface
     */
    private $group;
    /**
     * @var int
     */
    private $point = 0;
    /**
     * @var int
     */
    private $position = 0;
    /**
     * @var TeamInterface
     */
    private $team;

    /**
     * @return int
     */
    public function getGamesDrawn(): int
    {
        return $this->gamesDrawn;
    }

    /**
     * @return int
     */
    public function getGamesLost(): int
    {
        return $this->gamesLost;
    }

    /**
     * @return int
     */
    public function getGamesPlayed(): int
    {
        return $this->gamesPlayed;
    }

    /**
     * @return int
     */
    public function getGamesWon(): int
    {
        return $this->gamesWon;
    }

    /**
     * @return int
     */
    public function getGoalDifference(): int
    {
        return $this->goalDifference;
    }

    /**
     * @return GroupInterface
     */
    public function getGroup(): GroupInterface
    {
        return $this->group;
    }

    /**
     * @return int
     */
    public function getPoint(): int
    {
        return $this->point;
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @return TeamInterface
     */
    public function getTeam(): TeamInterface
    {
        return $this->team;
    }

    /**
     * @param int $amount
     * @return GroupResultInterface
     */
    public function setGamesDrawn(int $amount): GroupResultInterface
    {
        $this->gamesDrawn = $amount;
        return $this;
    }

    /**
     * @param int $amount
     * @return GroupResultInterface
     */
    public function setGamesLost(int $amount): GroupResultInterface
    {
        $this->gamesLost = $amount;
        return $this;
    }

    /**
     * @param int $amount
     * @return GroupResultInterface
     */
    public function setGamesPlayed(int $amount): GroupResultInterface
    {
        $this->gamesPlayed = $amount;
        return $this;
    }

    /**
     * @param int $amount
     * @return GroupResultInterface
     */
    public function setGamesWon(int $amount): GroupResultInterface
    {
        $this->gamesWon = $amount;
        return $this;
    }

    /**
     * @param int $amount
     * @return GroupResultInterface
     */
    public function setGoalDifference(int $amount): GroupResultInterface
    {
        $this->goalDifference = $amount;
        return $this;
    }

    /**
     * @param GroupInterface $group
     */
    public function setGroup(GroupInterface $group): void
    {
        $this->group = $group;
    }

    /**
     * @param int $amount
     * @return GroupResultInterface
     */
    public function setPoint(int $amount): GroupResultInterface
    {
        $this->point = $amount;
        return $this;
    }

    /**
     * @param int $position
     * @return GroupResult
     */
    public function setPosition(int $position): self
    {
        $this->position = $position;
        return $this;
    }

    /**
     * @param TeamInterface $team
     * @return GroupResultInterface
     */
    public function setTeam(TeamInterface $team): GroupResultInterface
    {
        $this->team = $team;
        return $this;
    }
}
