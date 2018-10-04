<?php
declare(strict_types=1);

namespace Ka\Tournament\Modules\Group\Models;

use Ka\Tournament\Modules\Common\Interfaces\Group\Models\GroupInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\Models\MatchResultInterface;
use Ka\Tournament\Modules\Common\Interfaces\Team\Models\TeamInterface;
use Ka\Tournament\Modules\Group\Models\Query\GroupQuery;
use Ka\Tournament\Modules\Match\Models\MatchResult;
use Ka\Tournament\Modules\Team\Models\Team;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "group".
 *
 * @property int $id
 * @property string $label
 * @property \Ka\Tournament\Modules\Common\Interfaces\Match\Models\MatchResultInterface[] $matchResults
 * @property TeamInterface[] $teams
 */
class Group extends ActiveRecord implements GroupInterface
{
    /**
     * {@inheritdoc}
     * @return GroupQuery the active query used by this AR class.
     */
    public static function find(): GroupQuery
    {
        return new GroupQuery(static::class);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'group';
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
     * {@inheritdoc}
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return MatchResultInterface[]|ActiveQuery
     */
    public function getMatchResults(): array
    {
        return $this->hasMany(MatchResult::class, ['group_id' => 'id'])->all();
    }

    /**
     * {@inheritdoc}
     * @return TeamInterface[]|[]
     */
    public function getTeams(): array
    {
        return $this->hasMany(Team::class, ['group_id' => 'id'])->all();
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
