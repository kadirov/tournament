<?php
declare(strict_types=1);

namespace Ka\Tournament\Modules\PlayOff;

use yii\base\Module;

/**
 * playoff module definition class
 */
class PlayOffModule extends Module
{
    /**
     * {@inheritdoc}
     */
    public function init(): void
    {
        $this->controllerNamespace = 'Ka\Tournament\Modules\PlayOff\Controllers';

        parent::init();
    }
}
