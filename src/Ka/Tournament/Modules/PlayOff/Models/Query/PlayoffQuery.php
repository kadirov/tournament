<?php

namespace Ka\Tournament\Modules\PlayOff\Models\Query;

use Ka\Tournament\Modules\PlayOff\Models\PlayOff;

/**
 * This is the ActiveQuery class for [[\Ka\Tournament\Modules\PlayOff\Models\PlayOff]].
 *
 * @see \Ka\Tournament\Modules\PlayOff\Models\PlayOff
 */
class PlayoffQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return PlayOff[]|[]
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PlayOff|[]|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param string $label
     * @return PlayoffQuery
     */
    public function byLabel(string $label): self
    {
        return $this->andWhere(['label' => $label]);
    }

    /**
     * @param array $labels
     * @return PlayoffQuery
     */
    public function byLabels(array $labels): self
    {
        return $this->andWhere(['label' => $labels]);
    }
}
