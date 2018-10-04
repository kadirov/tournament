<?php
declare(strict_types=1);

namespace Ka\Tournament\Modules\Tournament;

use yii\base\Module;

/**
 * tournament module definition class
 */
class TournamentModule extends Module
{
    /**
     * {@inheritdoc}
     */
    public function init(): void
    {
        $this->controllerNamespace = 'Ka\Tournament\Modules\Tournament\Controllers';

        parent::init();
    }
}
