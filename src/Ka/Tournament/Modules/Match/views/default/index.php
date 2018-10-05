<?php

/**
 * @var MatchResultInterface[] $matchResults
 * @var \yii\web\View $this
 */

use Ka\Tournament\Modules\Common\Interfaces\Match\Models\MatchResultInterface;

$this->params['breadcrumbs'][] = 'All Matches';
?>

<div class="match-default-index">
    <h1>All Matches</h1>

    <?= $this->render('parts/match-details', ['matchResults' => $matchResults]); ?>

</div>
