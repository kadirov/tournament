<?php

/**
 * @var GroupResultInterface[][] $allGroupsResults
 */

use Ka\Tournament\Modules\Common\Interfaces\Group\Models\GroupResultInterface;
use yii\helpers\Url;

?>
<div class="group-default-index">
    <h1>Groups</h1>
    <?php
    foreach ($allGroupsResults as $groupsResults):?>
        <p>
            <?= isset($groupsResults[0]) ? 'Group: ' . $groupsResults[0]->getGroup()->getLabel() : '' ?>
        </p>
        <table class="table table-striped">
            <tr>
                <th>P</th>
                <th width="200">Team</th>
                <th>Played</th>
                <th>Won</th>
                <th>Drawn</th>
                <th>Lost</th>
                <th>Goal Difference</th>
                <th>Points</th>
            </tr>
            <?php foreach ($groupsResults as $groupResult): ?>
                <tr class="<?= $groupResult->getGamesPlayed() === 3 && $groupResult->getPosition() <= 2 ? 'success' : '' ?>">
                    <?php $urlToMatches = Url::to([
                        '/match/default/team-matches-in-group',
                        'teamId' => $groupResult->getTeam()->getId(),
                        'groupId' => $groupResult->getGroup()->getId(),

                    ]) ?>
                    <td><?= $groupResult->getPosition() ?></td>
                    <td><a href="<?= $urlToMatches ?>"><?= $groupResult->getTeam()->getName() ?></a></td>
                    <td><?= $groupResult->getGamesPlayed() ?></td>
                    <td><?= $groupResult->getGamesWon() ?></td>
                    <td><?= $groupResult->getGamesDrawn() ?></td>
                    <td><?= $groupResult->getGamesLost() ?></td>
                    <td><?= $groupResult->getGoalDifference() ?></td>
                    <td><?= $groupResult->getPoint() ?></td>
                </tr>
            <?php endforeach ?>
        </table>

    <?php endforeach ?>
</div>
