<?php return array (
  'invokables' =>
  array (
    'Gear\Util\Vector\ArrayService' => 'Gear\Util\Vector\ArrayService',
    'Gear\Mvc\View\App\AppServiceSpecService' => 'Gear\Mvc\View\App\AppServiceSpecService',
    'Gear\Mvc\View\App\AppControllerSpecService' => 'Gear\Mvc\View\App\AppControllerSpecService',
    'Gear\Mvc\View\App\AppServiceService' => 'Gear\Mvc\View\App\AppServiceService',
    'Gear\Mvc\View\App\AppControllerService' => 'Gear\Mvc\View\App\AppControllerService',
    'Gear\Constructor\App\AppService' => 'Gear\Constructor\App\AppService',
    'Gear\Creator\FileCreator\AppTest\Vars' => 'Gear\Creator\FileCreator\AppTest\Vars',
    'Gear\Creator\FileCreator\AppTest\BeforeEach' => 'Gear\Creator\FileCreator\AppTest\BeforeEach',
    'Gear\Creator\FileCreator\App\ConstructorArgs' => 'Gear\Creator\FileCreator\App\ConstructorArgs',
    'Gear\Creator\FileCreator\App\Inject' => 'Gear\Creator\FileCreator\App\Inject',
    'Gear\Table\TableService' => 'Gear\Table\TableService',
    'Gear\Table\MetadataService' => 'Gear\Table\MetadataService',
    'Gear\Generator\Code\UseService' => 'Gear\Generator\Code\UseService',
    'Gear\Generator\Code\UseStack' => 'Gear\Generator\Code\UseStack',
    'Gear\Util\Yaml\YamlService' => 'Gear\Util\Yaml\YamlService',
  ),
  'factories' =>
  array (
    'Gear\Diagnostic\Dir' => 'Gear\Diagnostic\Dir\DirServiceFactory',
    'Gear\Mvc\TraitTest' => 'Gear\Mvc\TraitTestServiceFactory',
    'Gear\Project\DiagnosticService' => 'Gear\Project\Diagnostic\DiagnosticServiceFactory',
    'Gear\Diagnostic\Ant' => 'Gear\Diagnostic\Ant\AntServiceFactory',
    'Gear\Column\ColumnService' => 'Gear\Column\ColumnServiceFactory',
    'Gear\Diagnostic\NpmService' => 'Gear\Diagnostic\NpmServiceFactory',
    'Gear\Diagnostic\FileService' => 'Gear\Diagnostic\File\FileServiceFactory',
    'Gear\Diagnostic\ComposerService' => 'Gear\Diagnostic\ComposerServiceFactory',
    'Gear\Util\YamlService' => 'Gear\Util\YamlServiceFactory',
    'Gear\Edge\ComposerEdge' => 'Gear\Edge\ComposerEdgeFactory',
    'Gear\Upgrade\ComposerUpgrade' => 'Gear\Upgrade\ComposerUpgradeFactory',
    'Gear\Edge\NpmEdge' => 'Gear\Edge\NpmEdgeFactory',
    'Gear\Upgrade\NpmUpgrade' => 'Gear\Upgrade\NpmUpgradeFactory',
    'Gear\Edge\AntEdge' => 'Gear\Edge\AntEdge\AntEdgeFactory',
    'Gear\Edge\FileEdge' => 'Gear\Edge\FileEdgeFactory',
    'Gear\Edge\DirEdge' => 'Gear\Edge\DirEdgeFactory',
    'Gear\Module\Upgrade\ModuleUpgrade' => 'Gear\Module\Upgrade\ModuleUpgradeFactory',
    'Gear\Project\Upgrade\ProjectUpgrade' => 'Gear\Project\Upgrade\ProjectUpgradeFactory',
    'Gear\Upgrade\AntUpgrade' => 'Gear\Upgrade\AntUpgradeFactory',
    'Gear\Upgrade\DirUpgrade' => 'Gear\Upgrade\DirUpgradeFactory',
    'Gear\Upgrade\FileUpgrade' => 'Gear\Upgrade\FileUpgradeFactory',
    'Gear\Util\Prompt\ConsolePrompt' => 'Gear\Util\Prompt\ConsolePromptFactory',
  ),
  'shared' =>
  array (
    'Gear\Generator\Code\UseStack' => false,
  ),
  '' =>
  array (
    'Gear\Upgrade\AbstractUpgrade' => 'Gear\Upgrade\AbstractUpgrade',
  ),
);
