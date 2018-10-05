<?php

/**
 * @var MatchResultInterface[] $matchResults
 * @var string $groupLabel
 * @var \yii\web\View $this
 */

use Ka\Tournament\Modules\Common\Interfaces\Match\Models\MatchResultInterface;
use yii\helpers\Url;

$this->params['breadcrumbs'][] = [
    'label' => 'All Matches',
    'url' => Url::to('/match'),
];

$this->params['breadcrumbs'][] = 'Matches in group';

?>

<div class="match-default-index">
    <h1>Matches in group <?= $groupLabel ?></h1>

    <?= $this->render('parts/match-details', ['matchResults' => $matchResults]); ?>

</div>
