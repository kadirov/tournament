<?php

namespace Ka\Tournament\Modules\PlayOff;

/**
 * playoff module definition class
 */
class PlayOffModule extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->controllerNamespace = 'Ka\Tournament\Modules\PlayOff\Controllers';

        parent::init();
    }
}
