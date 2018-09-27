<?php

/**
 * @var MatchResultInterface[] $matchResults
 */

use Ka\Tournament\Modules\Common\Interfaces\Match\Models\MatchResultInterface;
use Ka\Tournament\Modules\Match\Helpers\MatchHelper;

$lastGroup = '';
$lastPlayOff = '';
?>

<table class="table table-striped ">
    <?php foreach ($matchResults as $mr): ?>

        <?php if (MatchHelper::isPlayOff($mr)): ?>
            <?php if (MatchHelper::isFinal($mr)): ?>
                <tr>
                    <td colspan="5" class="info">Final</td>
                </tr>

            <?php elseif (MatchHelper::isMatchForThirdPlace($mr)): ?>
                <tr>
                    <td colspan="5" class="info">Match for Third Place</td>
                </tr>

            <?php elseif ($lastPlayOff !== 'semi-final' && MatchHelper::isSemiFinal($mr)): ?>
                <tr>
                    <td colspan="5" class="info">Semi-Final</td>
                </tr>
                <?php $lastPlayOff = 'semi-final' ?>

            <?php elseif ($lastPlayOff !== 'quarter-final' && MatchHelper::isQuarterFinal($mr)): ?>
                <tr>
                    <td colspan="5" class="info">Quarter-Final</td>
                </tr>
                <?php $lastPlayOff = 'quarter-final' ?>

            <?php elseif ($lastPlayOff !== 'round-16' && MatchHelper::isRound16($mr)): ?>
                <tr>
                    <td colspan="5" class="info">Round of 16</td>
                </tr>
                <?php $lastPlayOff = 'round-16';
            endif ?>

        <?php elseif ($mr->getGroup() !== null && $mr->getGroup() != $lastGroup): ?>
            <tr>
                <td colspan="5" class="info">Group: <?= $mr->getGroup()->getLabel() ?></td>
            </tr>
            <?php $lastGroup = $mr->getGroup();
        endif ?>
        <tr>
            <th width="1%"
                class="<?= $mr->isFirstTeamWon() ? 'success' : '' ?> <?= $mr->isSecondTeamWon() ? 'danger' : '' ?>"></th>
            <th width="48%"><?= $mr->getTeam1()->getName() ?></th>
            <td>
                <?= $mr->getFinalScore()->getFirstTeamScore() ?> :
                <?= $mr->getFinalScore()->getSecondTeamScore() ?>
            </td>
            <th class="text-right"><?= $mr->getTeam2()->getName() ?></th>
            <th width="1%"
                class="<?= $mr->isSecondTeamWon() ? 'success' : '' ?> <?= $mr->isFirstTeamWon() ? 'danger' : '' ?>"></th>
        </tr>
    <?php endforeach ?>
</table>

