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
            <?php
            if (isset($groupsResults[0])) {
                $groupMatchesUrl = Url::to([
                    '/match/default/matches-in-group',
                    'groupId' => $groupsResults[0]->getGroup()->getId(),
                ]);
                print 'Group: ';
                print $groupsResults[0]->getGroup()->getLabel();
                print '. <a href="' . $groupMatchesUrl . '">See matches</a>';
            }
            ?>
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
                    <?php $teamMatchesUrl = Url::to([
                        '/match/default/team-matches',
                        'teamId' => $groupResult->getTeam()->getId(),
                    ]) ?>
                    <td><?= $groupResult->getPosition() ?></td>
                    <td><a href="<?= $teamMatchesUrl ?>"><?= $groupResult->getTeam()->getName() ?></a></td>
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
