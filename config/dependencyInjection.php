<?php

use Ka\Tournament\Modules\Common\Interfaces\Group\DrawingGroupInterface;
use Ka\Tournament\Modules\Common\Interfaces\Group\GroupGamesInterface;
use Ka\Tournament\Modules\Common\Interfaces\Group\GroupManagerInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\MatchResultBuilderInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\MatchResultManagerInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\ScoreGeneratorInterface;
use Ka\Tournament\Modules\Common\Interfaces\Match\ScoreManagerInterface;
use Ka\Tournament\Modules\Common\Interfaces\PlayOff\PlayOffGamesInterface;
use Ka\Tournament\Modules\Common\Interfaces\Team\TeamManagerInterface;
use Ka\Tournament\Modules\Common\Interfaces\Tournament\Memento\TournamentCaretakerInterface;
use Ka\Tournament\Modules\Common\Interfaces\Tournament\TournamentInterface;
use Ka\Tournament\Modules\Group\Components\DrawingGroup;
use Ka\Tournament\Modules\Group\Components\GroupGames;
use Ka\Tournament\Modules\Group\Components\GroupManager;
use Ka\Tournament\Modules\Match\Components\MatchResultBuilder;
use Ka\Tournament\Modules\Match\Components\MatchResultManager;
use Ka\Tournament\Modules\Match\Components\ScoreGenerator;
use Ka\Tournament\Modules\Match\Components\ScoreManager;
use Ka\Tournament\Modules\PlayOff\Components\PlayOffGames;
use Ka\Tournament\Modules\Team\Components\TeamManager;
use Ka\Tournament\Modules\Tournament\Components\Memento\TournamentCaretaker;
use Ka\Tournament\Modules\Tournament\Components\Tournament;

// Tournament
\Yii::$container->set(TournamentInterface::class, Tournament::class);
\Yii::$container->set(TournamentCaretakerInterface::class, TournamentCaretaker::class);

// Group
\Yii::$container->set(DrawingGroupInterface::class, DrawingGroup::class);
\Yii::$container->set(TeamManagerInterface::class, TeamManager::class);
\Yii::$container->set(GroupManagerInterface::class, GroupManager::class);
\Yii::$container->set(GroupGamesInterface::class, GroupGames::class);

// PlayOff
\Yii::$container->set(PlayOffGamesInterface::class, PlayOffGames::class);

// Match
\Yii::$container->set(MatchResultBuilderInterface::class, MatchResultBuilder::class);
\Yii::$container->set(MatchResultManagerInterface::class, MatchResultManager::class);
\Yii::$container->set(ScoreGeneratorInterface::class, ScoreGenerator::class);
\Yii::$container->set(ScoreManagerInterface::class, ScoreManager::class);

