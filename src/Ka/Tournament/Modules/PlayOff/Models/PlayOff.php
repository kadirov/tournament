<?php
declare(strict_types=1);

namespace Ka\Tournament\Modules\PlayOff\Models;

use Ka\Tournament\Modules\Common\Interfaces\PlayOff\Models\PlayOffInterface;
use Ka\Tournament\Modules\Common\Interfaces\Team\Models\TeamInterface;
use Ka\Tournament\Modules\PlayOff\Models\Query\PlayoffQuery;
use Ka\Tournament\Modules\Team\Models\Team;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "playoff".
 *
 * @property int $id
 * @property array|\Ka\Tournament\Modules\Common\Interfaces\Team\Models\TeamInterface[] $teams
 * @property string $label
 */
class PlayOff extends ActiveRecord implements PlayOffInterface
{
    /**
     * {@inheritdoc}
     * @return PlayoffQuery the active query used by this AR class.
     */
    public static function find(): PlayoffQuery
    {
        return new PlayoffQuery(static::class);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'playoff';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'label' => 'Label'
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * {@inheritdoc}
     * @return TeamInterface[]|[]
     */
    public function getTeams(): array
    {
        return $this->hasMany(Team::class, ['playoff_id' => 'id'])->all();
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['label'], 'string', 'max' => 255]
        ];
    }
}
