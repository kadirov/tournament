<?php

namespace Ka\Tournament\Modules\Team\Models\Query;

/**
 * This is the ActiveQuery class for [[\Ka\Tournament\Modules\Team\Models\Team]].
 *
 * @see \Ka\Tournament\Modules\Team\Models\Team
 */
class TeamQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return \Ka\Tournament\Modules\Team\Models\Team[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \Ka\Tournament\Modules\Team\Models\Team|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return TeamQuery
     */
    public function hasPlayOff(): self
    {
        return $this->andWhere(['not', ['playoff_id' => null]]);
    }
}
