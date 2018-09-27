<?php

namespace Ka\Tournament\Modules\Group\Models\Query;

/**
 * This is the ActiveQuery class for [[\Ka\Tournament\Modules\Group\Models\Group]].
 *
 * @see \Ka\Tournament\Modules\Group\Models\Group
 */
class GroupQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return \Ka\Tournament\Modules\Group\Models\Group[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \Ka\Tournament\Modules\Group\Models\Group|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
