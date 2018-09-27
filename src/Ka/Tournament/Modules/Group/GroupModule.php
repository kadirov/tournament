<?php

namespace Ka\Tournament\Modules\Group;

/**
 * Group module definition class
 */
class GroupModule extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->controllerNamespace = 'Ka\Tournament\Modules\Group\Controllers';

        parent::init();
    }
}
