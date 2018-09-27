<?php

namespace Ka\Tournament\Modules\Tournament;

/**
 * tournament module definition class
 */
class TournamentModule extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->controllerNamespace = 'Ka\Tournament\Modules\Tournament\Controllers';

        parent::init();
    }
}
