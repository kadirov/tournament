<?php declare(strict_types=1);

namespace Ka\Tournament\Modules\Match\Helpers;

use Ka\Tournament\Modules\Common\Constants\PlayOffLabel;
use Ka\Tournament\Modules\Common\Interfaces\Match\Models\MatchResultInterface;

/**
 * Class MatchHelper
 * @package Ka\Tournament\Modules\Match\Helpers
 */
class MatchHelper
{
    /**
     * @param MatchResultInterface $matchResult
     * @return bool
     */
    public static function isFinal(MatchResultInterface $matchResult): bool
    {
        if ($matchResult->getPlayOff() === null) {
            return false;
        }

        return $matchResult->getPlayOff()->getLabel() === PlayOffLabel::FINAL;
    }

    /**
     * @param MatchResultInterface $matchResult
     * @return bool
     */
    public static function isMatchForThirdPlace(MatchResultInterface $matchResult): bool
    {
        if ($matchResult->getPlayOff() === null) {
            return false;
        }
        return $matchResult->getPlayOff()->getLabel() === PlayOffLabel::FOR_THIRD_PLACE;
    }

    /**
     * Is match played in play off stage
     *
     * @param MatchResultInterface $matchResult
     * @return bool
     */
    public static function isPlayOff(MatchResultInterface $matchResult): bool
    {
        return $matchResult->getPlayOff() !== null;
    }

    /**
     * @param MatchResultInterface $matchResult
     * @return bool
     */
    public static function isQuarterFinal(MatchResultInterface $matchResult): bool
    {
        if ($matchResult->getPlayOff() === null) {
            return false;
        }

        switch ($matchResult->getPlayOff()->getLabel()) {
            case PlayOffLabel::QUARTER_FINAL_ABCD1:
            case PlayOffLabel::QUARTER_FINAL_ABCD2:
            case PlayOffLabel::QUARTER_FINAL_EFGH1:
            case PlayOffLabel::QUARTER_FINAL_EFGH2:
                return true;
            default:
                return false;
        }
    }

    /**
     * @param MatchResultInterface $matchResult
     * @return bool
     */
    public static function isRound16(MatchResultInterface $matchResult): bool
    {
        if ($matchResult->getPlayOff() === null) {
            return false;
        }

        switch ($matchResult->getPlayOff()->getLabel()) {
            case PlayOffLabel::A1B2:
            case PlayOffLabel::A2B1:
            case PlayOffLabel::C1D2:
            case PlayOffLabel::C2D1:
            case PlayOffLabel::E1F2:
            case PlayOffLabel::E2F1:
            case PlayOffLabel::G1H2:
            case PlayOffLabel::G2H1:
                return true;
            default:
                return false;
        }
    }

    /**
     * @param MatchResultInterface $matchResult
     * @return bool
     */
    public static function isSemiFinal(MatchResultInterface $matchResult): bool
    {
        if ($matchResult->getPlayOff() === null) {
            return false;
        }

        switch ($matchResult->getPlayOff()->getLabel()) {
            case PlayOffLabel::SEMI_FINAL_1:
            case PlayOffLabel::SEMI_FINAL_2:
                return true;
            default:
                return false;
        }
    }
}
