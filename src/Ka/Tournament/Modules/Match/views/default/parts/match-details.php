<?php

/**
 * @var MatchResultInterface[] $matchResults
 */

use Ka\Tournament\Modules\Common\Interfaces\Match\Models\MatchResultInterface;
use Ka\Tournament\Modules\Match\Helpers\MatchHelper;
use yii\helpers\Url;

$lastGroup = '';
$lastPlayOff = '';
?>

<table class="table table-striped ">
    <?php foreach ($matchResults as $mr): ?>

        <?php if (MatchHelper::isPlayOff($mr)): ?>
            <?php if (MatchHelper::isFinal($mr)): ?>
                <tr>
                    <td colspan="5" class="bg-primary">Final</td>
                </tr>

            <?php elseif (MatchHelper::isMatchForThirdPlace($mr)): ?>
                <tr>
                    <td colspan="5" class="bg-primary">Match for Third Place</td>
                </tr>

            <?php elseif ($lastPlayOff !== 'semi-final' && MatchHelper::isSemiFinal($mr)): ?>
                <tr>
                    <td colspan="5" class="bg-primary">Semi-Final</td>
                </tr>
                <?php $lastPlayOff = 'semi-final' ?>

            <?php elseif ($lastPlayOff !== 'quarter-final' && MatchHelper::isQuarterFinal($mr)): ?>
                <tr>
                    <td colspan="5" class="bg-primary">Quarter-Final</td>
                </tr>
                <?php $lastPlayOff = 'quarter-final' ?>

            <?php elseif ($lastPlayOff !== 'round-16' && MatchHelper::isRound16($mr)): ?>
                <tr>
                    <td colspan="5" class="bg-primary">Round of 16</td>
                </tr>
                <?php $lastPlayOff = 'round-16';
            endif ?>

        <?php elseif ($mr->getGroup() !== null && $mr->getGroup() != $lastGroup): ?>
            <?php
            $groupMatchesUrl = Url::to([
                '/match/default/matches-in-group',
                'groupId' => $mr->getGroup()->getId(),
            ]);
            ?>
            <tr>
                <td colspan="5" class="bg-primary">
                    Group: <?= $mr->getGroup()->getLabel() ?> <a href="<?= $groupMatchesUrl ?>" class="label label-primary">See matches</a>
                </td>
            </tr>
            <?php $lastGroup = $mr->getGroup();
        endif ?>
        <tr>
            <th width="1%"
                class="<?= $mr->isFirstTeamWon() ? 'success' : '' ?> <?= $mr->isSecondTeamWon() ? 'danger' : '' ?>"></th>
            <td width="48%">
                <?php $team1MatchesUrl = Url::to([
                    '/match/default/team-matches',
                    'teamId' => $mr->getTeam1()->getId(),
                ]) ?>

                <?php $team2MatchesUrl = Url::to([
                    '/match/default/team-matches',
                    'teamId' => $mr->getTeam2()->getId(),
                ]) ?>

                <a href="<?= $team1MatchesUrl ?>"><?= $mr->getTeam1()->getName() ?></a>

                <span class="text-muted text-muted" style="font-weight: normal">
                    <?= $mr->getPenaltiesScore() === null ? '' : '<br>Penalties' ?>
                    <?= $mr->getAdditionalTimesScore() === null ? '' : '<br>Additional times result<br>Second time result' ?>
                </span>
            </td>
            <td>
                <?= $mr->getFinalScore()->getFirstTeamScore() ?> :
                <?= $mr->getFinalScore()->getSecondTeamScore() ?>
                <span class="text-muted text-muted" style="font-weight: normal">
                    <?= $mr->getPenaltiesScore() === null ? '' : '<br>' . $mr->getPenaltiesScore()->getFirstTeamScore() . ' : ' . $mr->getPenaltiesScore()->getSecondTeamScore() ?>
                    <?= $mr->getAdditionalTimesScore() === null ? '' : '<br>' . $mr->getAdditionalTimesScore()->getFirstTeamScore() . ' : ' . $mr->getAdditionalTimesScore()->getSecondTeamScore() ?>
                    <?= $mr->getAdditionalTimesScore() === null ? '' : '<br>' . $mr->getSecondTimeScore()->getFirstTeamScore() . ' : ' . $mr->getSecondTimeScore()->getSecondTeamScore() ?>
                </span>
            </td>
            <td class="text-right">
                <a href="<?= $team2MatchesUrl ?>"><?= $mr->getTeam2()->getName() ?></a>

                <span class="text-muted text-muted" style="font-weight: normal">
                    <?= $mr->getPenaltiesScore() === null ? '' : '<br>Penalties' ?>
                    <?= $mr->getAdditionalTimesScore() === null ? '' : '<br>Additional times result<br>Second time result' ?>
                </span>
            </td>
            <th width="1%"
                class="<?= $mr->isSecondTeamWon() ? 'success' : '' ?> <?= $mr->isFirstTeamWon() ? 'danger' : '' ?>"></th>
        </tr>
    <?php endforeach ?>
</table>

