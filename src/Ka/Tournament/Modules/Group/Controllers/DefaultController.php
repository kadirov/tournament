<?php
declare(strict_types=1);

namespace Ka\Tournament\Modules\Group\Controllers;

use Ka\Tournament\Modules\Common\Interfaces\Group\GroupManagerInterface;
use Ka\Tournament\Modules\Group\Models\Group;
use yii\base\Module;
use yii\web\Controller;

/**
 * Default controller for the `group` module
 */
class DefaultController extends Controller
{
    /**
     * @var GroupManagerInterface
     */
    private $groupManager;

    /**
     * DefaultController constructor.
     * @param string $id
     * @param Module $module
     * @param GroupManagerInterface $groupManager
     */
    public function __construct(
        string $id,
        Module $module,
        GroupManagerInterface $groupManager
    ) {
        $this->groupManager = $groupManager;

        parent::__construct($id, $module);
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex(): string
    {
        $allGroupsResults = [];

        foreach (Group::find()->all() as $group) {
            $allGroupsResults[] = $this->getGroupManager()->getGroupResults($group);
        }

        return $this->render('index', [
            'allGroupsResults' => $allGroupsResults
        ]);
    }

    /**
     * @return GroupManagerInterface
     */
    private function getGroupManager(): GroupManagerInterface
    {
        return $this->groupManager;
    }
}
