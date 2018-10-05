<?php

/**
 * @var MatchResultInterface[] $matchResults
 * @var string $groupLabel
 * @var \yii\web\View $this
 */

use Ka\Tournament\Modules\Common\Interfaces\Match\Models\MatchResultInterface;

?>

<div class="match-default-index">
    <h1>Matches in group <?= $groupLabel ?></h1>

    <?= $this->render('parts/match-details', ['matchResults' => $matchResults]); ?>

</div>
