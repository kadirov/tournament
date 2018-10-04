<?php
declare(strict_types=1);

namespace Ka\Tournament\Modules\PlayOff\Controllers;

use Ka\Tournament\Modules\Common\Interfaces\Team\TeamManagerInterface;
use yii\base\Module;
use yii\web\Controller;

/**
 * Default controller for the `playoff` module
 */
class DefaultController extends Controller
{
    /**
     * @var TeamManagerInterface
     */
    private $teamManager;

    /**
     * DefaultController constructor.
     * @param string $id
     * @param Module $module
     * @param TeamManagerInterface $teamManager
     */
    public function __construct(string $id, Module $module, TeamManagerInterface $teamManager)
    {
        $this->teamManager = $teamManager;
        parent::__construct($id, $module);
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex(): string
    {
        return $this->render('index', ['teams' => $this->getTeamManager()->getTeamsInPlayOff()]);
    }

    /**
     * @return TeamManagerInterface
     */
    private function getTeamManager(): TeamManagerInterface
    {
        return $this->teamManager;
    }
}
