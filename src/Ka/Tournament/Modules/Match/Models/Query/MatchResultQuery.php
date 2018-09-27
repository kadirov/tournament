<?php

namespace Ka\Tournament\Modules\Match\Models\Query;

use Ka\Tournament\Modules\Common\Interfaces\Group\Models\GroupInterface;
use Ka\Tournament\Modules\Common\Interfaces\Team\Models\TeamInterface;

/**
 * This is the ActiveQuery class for [[\Ka\Tournament\Modules\Match\Models\MatchResult]].
 *
 * @see \Ka\Tournament\Modules\Match\Models\MatchResult
 */
class MatchResultQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return \Ka\Tournament\Modules\Match\Models\MatchResult[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \Ka\Tournament\Modules\Match\Models\MatchResult|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param TeamInterface $team
     * @param GroupInterface $group
     * @return MatchResultQuery
     */
    public function teamMatchesInGroup(TeamInterface $team, GroupInterface $group): self
    {
        $this->andWhere([
            'group_id' => $group->getId(),
        ]);

        $this->andWhere([
            'or',
            ['team1_id' => $team->getId()],
            ['team2_id' => $team->getId()]
        ]);

        return $this;
    }

    /**
     * @return MatchResultQuery
     */
    public function orderedDesk(): self
    {
        return $this->orderBy(['id' => SORT_DESC]);
    }
}
