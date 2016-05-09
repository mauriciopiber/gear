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
  ),
  'factories' =>
  array (
    'Gear\Diagnostic\Ant' => 'Gear\Diagnostic\AntServiceFactory',
    'Gear\Column\ColumnService' => 'Gear\Column\ColumnServiceFactory',
  ),
  'shared' =>
  array (
    'Gear\Generator\Code\UseStack' => false,
  ),
);
