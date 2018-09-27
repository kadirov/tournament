<?php

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
 * @property string $label
 */
class PlayOff extends ActiveRecord implements PlayOffInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'playoff';
    }

    /**
     * {@inheritdoc}
     * @return PlayoffQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlayoffQuery(static::class);
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
     */
    public function rules()
    {
        return [
            [['label'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'label' => 'Label',
        ];
    }
}
