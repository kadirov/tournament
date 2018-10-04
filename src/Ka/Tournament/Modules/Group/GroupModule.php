<?php
declare(strict_types=1);

namespace Ka\Tournament\Modules\Group;

use yii\base\Module;

/**
 * Group module definition class
 */
class GroupModule extends Module
{
    /**
     * {@inheritdoc}
     */
    public function init(): void
    {
        $this->controllerNamespace = 'Ka\Tournament\Modules\Group\Controllers';

        parent::init();
    }
}
