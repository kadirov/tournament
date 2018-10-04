<?php
declare(strict_types=1);

namespace Ka\Tournament\Modules\PlayOff\Models\Query;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\Ka\Tournament\Modules\PlayOff\Models\PlayOff]].
 *
 * @see \Ka\Tournament\Modules\PlayOff\Models\PlayOff
 */
class PlayoffQuery extends ActiveQuery
{
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
