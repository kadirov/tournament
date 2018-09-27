<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Common\Constants;

class TournamentState
{
    /**
     * Drawing Groups
     */
    public const DRAW = 5;

    /**
     * First round
     */
    public const GROUP_ROUND_1 = 10;

    /**
     * Second Round
     */
    public const GROUP_ROUND_2 = 20;

    /**
     * Final round
     */
    public const GROUP_ROUND_3 = 30;

    /**
     * Prepare PlayOff
     */
    public const PLAYOFF_PREPARE = 100;

    /**
     * PlayOff 16
     */
    public const PLAYOFF_16 = 101;

    /**
     * PlayOff Quarter-final
     */
    public const PLAYOFF_QUARTER_FINAL = 110;

    /**
     * PlayOff semi-final
     */
    public const PLAYOFF_SEMI_FINAL = 120;

    /**
     * Match for third place
     */
    public const PLAYOFF_FOR_THIRD_PLACE = 130;

    /**
     * All games had finished
     */
    public const PLAYOFF_FINAL = 140;

    /**
     * All games had finished
     */
    public const FINISHED = 200;
}
