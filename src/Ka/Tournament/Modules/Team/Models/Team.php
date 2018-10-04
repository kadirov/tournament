<?php
declare(strict_types=1);

namespace Ka\Tournament\Modules\Team\Models;

use Ka\Tournament\Modules\Common\Interfaces\Group\Models\GroupInterface;
use Ka\Tournament\Modules\Common\Interfaces\PlayOff\Models\PlayOffInterface;
use Ka\Tournament\Modules\Common\Interfaces\Team\Models\TeamInterface;
use Ka\Tournament\Modules\Group\Models\Group;
use Ka\Tournament\Modules\PlayOff\Models\PlayOff;
use Ka\Tournament\Modules\Team\Models\Query\TeamQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "team".
 *
 * @property int $id
 * @property string $name
 * @property int $power
 * @property int $group_id
 * @property int $playoff_id
 * @property \yii\db\ActiveRecord|null|\Ka\Tournament\Modules\Common\Interfaces\PlayOff\Models\PlayOffInterface $playOff
 * @property GroupInterface $group
 */
class Team extends ActiveRecord implements TeamInterface
{
    /**
     * {@inheritdoc}
     * @return TeamQuery the active query used by this AR class.
     */
    public static function find(): TeamQuery
    {
        return new TeamQuery(static::class);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'team';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'power' => 'Power',
            'group_id' => 'Group ID',
            'playoff_id' => 'PlayOff ID'
        ];
    }

    /**
     * {@inheritdoc}
     * @return GroupInterface|null|ActiveRecord
     */
    public function getGroup(): ?GroupInterface
    {
        return $this->hasOne(Group::class, ['id' => 'group_id'])->one();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get name of the team.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return PlayOffInterface|null|ActiveRecord
     */
    public function getPlayOff(): ?PlayOffInterface
    {
        return $this->hasOne(PlayOff::class, ['id' => 'playoff_id'])->one();
    }

    /**
     * Power of team.
     *
     * It will be taken to result of match.
     *
     * @return int
     */
    public function getPower(): int
    {
        return $this->power;
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['power', 'group_id', 'playoff_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [
                ['group_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Group::class,
                'targetAttribute' => ['group_id' => 'id']
            ],
            [
                ['playoff_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => PlayOff::class,
                'targetAttribute' => ['playoff_id' => 'id']
            ]
        ];
    }

    /**
     * Get group of team.
     *
     * @param GroupInterface $group
     * @return \Ka\Tournament\Modules\Common\Interfaces\Team\Models\TeamInterface Returns null if team haven't group yet
     */
    public function setGroup(?GroupInterface $group): TeamInterface
    {
        if ($group === null) {
            $this->group_id = null;
            return $this;
        }

        $this->group_id = $group->getId();

        return $this;
    }

    /**
     * Get name of the team.
     *
     * @param string $name
     * @return \Ka\Tournament\Modules\Common\Interfaces\Team\Models\TeamInterface
     */
    public function setName(string $name): TeamInterface
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param PlayOffInterface $playOff
     * @return TeamInterface
     */
    public function setPlayOff(?PlayOffInterface $playOff): TeamInterface
    {
        if ($playOff === null) {
            $this->playoff_id = null;
            return $this;
        }

        $this->playoff_id = $playOff->getId();
        return $this;
    }

    /**
     * Power of team.
     *
     * It will be taken to result of match.
     *
     * @param int $power
     * @return \Ka\Tournament\Modules\Common\Interfaces\Team\Models\TeamInterface
     */
    public function setPower(int $power): TeamInterface
    {
        $this->power = $power;
        return $this;
    }
}
