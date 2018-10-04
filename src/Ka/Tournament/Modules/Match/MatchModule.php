<?php
declare(strict_types=1);

namespace Ka\Tournament\Modules\Match;

use yii\base\Module;

/**
 * match module definition class
 */
class MatchModule extends Module
{
    /**
     * {@inheritdoc}
     */
    public function init(): void
    {
        $this->controllerNamespace = 'Ka\Tournament\Modules\Match\Controllers';

        parent::init();
    }
}
