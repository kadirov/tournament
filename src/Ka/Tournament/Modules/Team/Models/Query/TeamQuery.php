<?php
declare(strict_types=1);

namespace Ka\Tournament\Modules\Team\Models\Query;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\Ka\Tournament\Modules\Team\Models\Team]].
 *
 * @see \Ka\Tournament\Modules\Team\Models\Team
 */
class TeamQuery extends ActiveQuery
{
    /**
     * @return TeamQuery
     */
    public function hasPlayOff(): self
    {
        return $this->andWhere(['not', ['playoff_id' => null]]);
    }
}
