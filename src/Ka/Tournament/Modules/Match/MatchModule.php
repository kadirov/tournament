<?php

namespace Ka\Tournament\Modules\Match;

/**
 * match module definition class
 */
class MatchModule extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->controllerNamespace = 'Ka\Tournament\Modules\Match\Controllers';

        parent::init();
    }
}
