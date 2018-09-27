<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Group\Models;

use Ka\Tournament\Modules\Common\Interfaces\Group\Models\GroupInterface;
use Ka\Tournament\Modules\Common\Interfaces\Group\Models\GroupResultInterface;
use Ka\Tournament\Modules\Common\Interfaces\Team\Models\TeamInterface;

class GroupResult implements GroupResultInterface
{
    /**
     * @var GroupInterface
     */
    private $group;

    /**
     * @var TeamInterface
     */
    private $team;

    /**
     * @var int
     */
    private $position = 0;

    /**
     * @var int
     */
    private $point = 0;

    /**
     * @var int
     */
    private $goalDifference = 0;

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
    private $gamesDrawn = 0;
    /**
     * @var int
     */
    private $gamesLost = 0;

    /**
     * @return GroupInterface
     */
    public function getGroup(): GroupInterface
    {
        return $this->group;
    }

    /**
     * @param GroupInterface $group
     */
    public function setGroup(GroupInterface $group): void
    {
        $this->group = $group;
    }

    /**
     * @return TeamInterface
     */
    public function getTeam(): TeamInterface
    {
        return $this->team;
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

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
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
     * @return int
     */
    public function getPoint(): int
    {
        return $this->point;
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
     * @return int
     */
    public function getGoalDifference(): int
    {
        return $this->goalDifference;
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
     * @return int
     */
    public function getGamesPlayed(): int
    {
        return $this->gamesPlayed;
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
     * @return int
     */
    public function getGamesWon(): int
    {
        return $this->gamesWon;
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
     * @return int
     */
    public function getGamesDrawn(): int
    {
        return $this->gamesDrawn;
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
     * @return int
     */
    public function getGamesLost(): int
    {
        return $this->gamesLost;
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
}
