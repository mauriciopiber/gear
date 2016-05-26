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
    'Gear\Project\DiagnosticService' => 'Gear\Project\DiagnosticService',
    'Gear\Util\Yaml\YamlService' => 'Gear\Util\Yaml\YamlService',
  ),
  'factories' =>
  array (
    'Gear\Diagnostic\Ant' => 'Gear\Diagnostic\AntServiceFactory',
    'Gear\Column\ColumnService' => 'Gear\Column\ColumnServiceFactory',
    'Gear\Diagnostic\NpmService' => 'Gear\Diagnostic\NpmServiceFactory',
    'Gear\Diagnostic\FileService' => 'Gear\Diagnostic\FileServiceFactory',
    'Gear\Diagnostic\ComposerService' => 'Gear\Diagnostic\ComposerServiceFactory',
    'Gear\Util\YamlService' => 'Gear\Util\YamlServiceFactory',
    'Gear\Edge\ComposerEdge' => 'Gear\Edge\ComposerEdgeFactory',
  ),
  'shared' =>
  array (
    'Gear\Generator\Code\UseStack' => false,
  ),
);
