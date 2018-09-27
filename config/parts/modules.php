<?php

return [
    'common' => ['class' => \Ka\Tournament\Modules\Common\CommonModule::class],
    'team' => ['class' => \Ka\Tournament\Modules\Team\TeamModule::class],
    'group' => ['class' => \Ka\Tournament\Modules\Group\GroupModule::class],
    'match' => ['class' => \Ka\Tournament\Modules\Match\MatchModule::class],
    'tournament' => ['class' => \Ka\Tournament\Modules\Tournament\TournamentModule::class],
    'playoff' => ['class' => \Ka\Tournament\Modules\PlayOff\PlayOffModule::class],
];
