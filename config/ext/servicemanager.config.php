<?php return [
    'invokables' => [
        'Gear\Util\Vector\ArrayService' => 'Gear\Util\Vector\ArrayService',

        'Gear\Constructor\App\AppService' => 'Gear\Constructor\App\AppService',
        'Gear\Creator\FileCreator\AppTest\Vars' => 'Gear\Creator\FileCreator\AppTest\Vars',
        'Gear\Creator\FileCreator\AppTest\BeforeEach' => 'Gear\Creator\FileCreator\AppTest\BeforeEach',
        'Gear\Creator\FileCreator\App\ConstructorArgs' => 'Gear\Creator\FileCreator\App\ConstructorArgs',
        'Gear\Creator\FileCreator\App\Inject' => 'Gear\Creator\FileCreator\App\Inject',
        'Gear\Generator\Code\UseService' => 'Gear\Generator\Code\UseService',
        'Gear\Generator\Code\UseStack' => 'Gear\Generator\Code\UseStack',
        'Gear\Util\Yaml\YamlService' => 'Gear\Util\Yaml\YamlService',
        'Gear\Integration\Columns\CompleteColumnsInterface' => 'Gear\Integration\Columns\CompleteColumnsInterface',
        'Gear\Integration\Columns\BasicColumnsInterface' => 'Gear\Integration\Columns\BasicColumnsInterface',
        'Gear\Integration\Columns\DatesColumnsInterface' => 'Gear\Integration\Columns\DatesColumnsInterface',
        'Gear\Integration\Columns\NumericColumnsInterface' => 'Gear\Integration\Columns\NumericColumnsInterface',
        'Gear\Integration\Columns\VarcharColumnsInterface' => 'Gear\Integration\Columns\VarcharColumnsInterface',
        'Gear\Integration\Columns\TextColumnsInterface' => 'Gear\Integration\Columns\TextColumnsInterface',
        'Gear\Integration\Suite\Src\SrcMinorSuite' => 'Gear\Integration\Suite\Src\SrcMinorSuite',
        'Gear\Integration\Suite\Src\SrcMajorSuite' => 'Gear\Integration\Suite\Src\SrcMajorSuite',
        'Gear\Integration\Suite\SrcMvc\SrcMvcMinorSuite' => 'Gear\Integration\Suite\SrcMvc\SrcMvcMinorSuite',
        'Gear\Integration\Suite\SrcMvc\SrcMvcMajorSuite' => 'Gear\Integration\Suite\SrcMvc\SrcMvcMajorSuite',
        'Gear\Integration\Suite\Mvc\MvcMinorSuite' => 'Gear\Integration\Suite\Mvc\MvcMinorSuite',
        'Gear\Integration\Suite\Mvc\MvcMajorSuite' => 'Gear\Integration\Suite\Mvc\MvcMajorSuite',
        'Gear\Integration\Suite\Controller\ControllerMinorSuite' => 'Gear\Integration\Suite\Controller\ControllerMinorSuite',
        'Gear\Integration\Suite\Controller\ControllerMajorSuite' => 'Gear\Integration\Suite\Controller\ControllerMajorSuite',
        'Gear\Integration\Suite\ControllerSrc\ControllerMvcMinorSuite' => 'Gear\Integration\Suite\ControllerSrc\ControllerMvcMinorSuite',
        'Gear\Integration\Suite\ControllerSrc\ControllerMvcMajorSuite' => 'Gear\Integration\Suite\ControllerSrc\ControllerMvcMajorSuite',
        'Gear\Integration\Util\Location\Location' => 'Gear\Integration\Util\Location\Location',
        'Gear\Integration\Util\Columns\Columns' => 'Gear\Integration\Util\Columns\Columns',
        'Gear\Mvc\Util\Glob\GlobService' => 'Gear\Mvc\Util\Glob\GlobService',
        'Gear\Util\Glob\GlobService' => 'Gear\Util\Glob\GlobService',
        'Gear\Mvc\Entity\EntityObjectFixer\EntityObject' => 'Gear\Mvc\Entity\EntityObjectFixer\EntityObject',
        'Gear\Creator\Codes\Code\AbstractCode' => 'Gear\Creator\Codes\Code\AbstractCode',
        'Gear\Creator\Codes\Code\FactoryCode\FactoryCode' => 'Gear\Creator\Codes\Code\FactoryCode\FactoryCode',
        'Gear\Creator\Codes\CodeTest\AbstractCodeTest' => 'Gear\Creator\Codes\CodeTest\AbstractCodeTest',
        'Gear\Creator\Codes\CodeTest\FactoryCode\FactoryCodeTest' => 'Gear\Creator\Codes\CodeTest\FactoryCode\FactoryCodeTest',
        'Gear\Column\ColumnManager' => 'Gear\Column\ColumnManager'
    ***REMOVED***,
    'factories' => [
        'Gear\Table\UploadImage' => 'Gear\Table\UploadImageFactory',
        'Gear\Creator\Template\TemplateService' => 'Gear\Creator\Template\TemplateServiceFactory',
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
        'Gear\Project\Composer\ComposerService' => 'Gear\Project\Composer\ComposerServiceFactory',
        'Gear\Module\Docs\Docs' => 'Gear\Module\Docs\DocsFactory',
        'Gear\Project\Docs\Docs' => 'Gear\Project\Docs\DocsFactory',
        'Gear\Mvc\Spec\Feature\Feature' => 'Gear\Mvc\Spec\Feature\FeatureFactory',
        'Gear\Mvc\Spec\Page\Page' => 'Gear\Mvc\Spec\Page\PageFactory',
        'Gear\Mvc\Spec\Step\Step' => 'Gear\Mvc\Spec\Step\StepFactory',
        'Gear\Mvc\Spec\UnitTest\UnitTest' => 'Gear\Mvc\Spec\UnitTest\UnitTestFactory',
        'Gear\Module\Config\ApplicationConfig' => 'Gear\Module\Config\ApplicationConfigFactory',
        'Gear\Autoload\ComposerAutoload' => 'Gear\Autoload\ComposerAutoloadFactory',
        'Gear\Creator\Injector\Injector' => 'Gear\Creator\Injector\InjectorFactory',
        'Gear\Database\Phinx\PhinxService' => 'Gear\Database\Phinx\PhinxServiceFactory',
        'Gear\Creator\Component\Constructor\ConstructorParams' => 'Gear\Creator\Component\Constructor\ConstructorParamsFactory',
        'Gear\Mvc\ValueObject\ValueObjectTestService' => 'Gear\Mvc\ValueObject\ValueObjectTestServiceFactory',
        'Gear\Integration\Util\ResolveNames\ResolveNames' => 'Gear\Integration\Util\ResolveNames\ResolveNamesFactory',
        'Gear\Integration\Util\Persist\Persist' => 'Gear\Integration\Util\Persist\PersistFactory',
        'Gear\Integration\Component\SuperTestFile\SuperTestFile' => 'Gear\Integration\Component\SuperTestFile\SuperTestFileFactory',
        'Gear\Integration\Component\TestFile\TestFile' => 'Gear\Integration\Component\TestFile\TestFileFactory',
        'Gear\Integration\Component\MigrationFile\MigrationFile' => 'Gear\Integration\Component\MigrationFile\MigrationFileFactory',
        'Gear\Integration\Component\GearFile\GearFile' => 'Gear\Integration\Component\GearFile\GearFileFactory',
        'Gear\Integration\Suite\Src\SrcGenerator\SrcGenerator' => 'Gear\Integration\Suite\Src\SrcGenerator\SrcGeneratorFactory',
        'Gear\Integration\Suite\Src\SrcSuite\SrcSuite' => 'Gear\Integration\Suite\Src\SrcSuite\SrcSuiteFactory',
        'Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGenerator' => 'Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGeneratorFactory',
        'Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuite' => 'Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuiteFactory',
        'Gear\Integration\Suite\Mvc\MvcGenerator\MvcGenerator' => 'Gear\Integration\Suite\Mvc\MvcGenerator\MvcGeneratorFactory',
        'Gear\Integration\Suite\Mvc\MvcSuite\MvcSuite' => 'Gear\Integration\Suite\Mvc\MvcSuite\MvcSuiteFactory',
        'Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGenerator' => 'Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGeneratorFactory',
        'Gear\Integration\Suite\SrcMvc\SrcMvcSuite\SrcMvcSuite' => 'Gear\Integration\Suite\SrcMvc\SrcMvcSuite\SrcMvcSuiteFactory',
        'Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator\ControllerMvcGenerator' => 'Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator\ControllerMvcGeneratorFactory',
        'Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite\ControllerMvcSuite' => 'Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite\ControllerMvcSuiteFactory',
        'Gear\Integration\Suite\Integration\Integration' => 'Gear\Integration\Suite\Integration\IntegrationFactory',
        'Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixer' => 'Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixerFactory'
    ***REMOVED***,
    'shared' => [
        'Gear\Generator\Code\UseStack' => false
    ***REMOVED***
***REMOVED***;
