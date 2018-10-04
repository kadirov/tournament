<?php
declare(strict_types=1);

namespace Ka\Tournament\Modules\Match\Controllers;

use Ka\Tournament\Modules\Common\Interfaces\Match\MatchResultManagerInterface;
use Ka\Tournament\Modules\Group\Models\Group;
use Ka\Tournament\Modules\Match\Models\MatchResult;
use Ka\Tournament\Modules\Team\Models\Team;
use yii\base\Module;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `match` module
 */
class DefaultController extends Controller
{
    /**
     * @var MatchResultManagerInterface
     */
    private $matchResultManager;

    /**
     * DefaultController constructor.
     * @param string $id
     * @param Module $module
     * @param MatchResultManagerInterface $matchResultManager
     */
    public function __construct(
        string $id,
        Module $module,
        MatchResultManagerInterface $matchResultManager
    ) {
        $this->matchResultManager = $matchResultManager;

        parent::__construct($id, $module);
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex(): string
    {
        $matchResults = MatchResult::find()->orderedDesk()->all();

        return $this->render('index', [
            'matchResults' => $matchResults
        ]);
    }

    /**
     * @param int $teamId
     * @param int $groupId
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionTeamMatchesInGroup(int $teamId, int $groupId): string
    {
        $team = Team::findOne($teamId);

        if ($team === null) {
            throw new NotFoundHttpException('Team is not found');
        }

        $group = Group::findOne($groupId);

        if ($group === null) {
            throw new NotFoundHttpException('Group is not found');
        }

        $matchResults = $this->getMatchResultManager()->getTeamMatchesInGroup($team, $group);

        return $this->render('team-matches-in-group', [
            'matchResults' => $matchResults
        ]);
    }

    /**
     * @return MatchResultManagerInterface
     */
    private function getMatchResultManager(): MatchResultManagerInterface
    {
        return $this->matchResultManager;
    }
}
