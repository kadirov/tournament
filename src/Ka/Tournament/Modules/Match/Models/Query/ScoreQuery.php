<?php

namespace Ka\Tournament\Modules\Match\Models\Query;

/**
 * This is the ActiveQuery class for [[\Ka\Tournament\Modules\Match\Models\Score]].
 *
 * @see \Ka\Tournament\Modules\Match\Models\Score
 */
class ScoreQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return \Ka\Tournament\Modules\Match\Models\Score[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \Ka\Tournament\Modules\Match\Models\Score|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
