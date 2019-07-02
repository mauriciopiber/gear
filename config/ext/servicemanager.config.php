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
        'Gear\Code\Codes\Code\AbstractCode' => 'Gear\Code\Codes\Code\AbstractCode',
        'Gear\Code\Codes\CodeTest\AbstractCodeTest' => 'Gear\Code\Codes\CodeTest\AbstractCodeTest',
        'Gear\Column\ColumnManager' => 'Gear\Column\ColumnManager'
    ***REMOVED***,
    'factories' => [
        'Gear\Code\FactoryCode\FactoryCode' => 'Gear\Code\FactoryCode\FactoryCodeFactory',
        'Gear\Code\FactoryCode\FactoryCodeTest' => 'Gear\Code\FactoryCode\FactoryCodeTestFactory',
        'Gear\Column\ColumnService' => 'Gear\Column\ColumnServiceFactory',
        'Gear\Table\UploadImage' => 'Gear\Table\UploadImageFactory',
        'Gear\Mvc\TraitTest' => 'Gear\Mvc\TraitTestServiceFactory',
        'Gear\Util\YamlService' => 'Gear\Util\YamlServiceFactory',
        'Gear\Diagnostic\Dir\DirService' => 'Gear\Diagnostic\Dir\DirServiceFactory',
        'Gear\Diagnostic\Ant\AntService' => 'Gear\Diagnostic\Ant\AntServiceFactory',
        'Gear\Diagnostic\Npm\NpmService' => 'Gear\Diagnostic\Npm\NpmServiceFactory',
        'Gear\Diagnostic\File\FileService' => 'Gear\Diagnostic\File\FileServiceFactory',
        'Gear\Diagnostic\Composer\ComposerService' => 'Gear\Diagnostic\Composer\ComposerServiceFactory',
        'Gear\Module\Upgrade\ModuleUpgrade' => 'Gear\Module\Upgrade\ModuleUpgradeFactory',
        'Gear\Project\Upgrade\ProjectUpgrade' => 'Gear\Project\Upgrade\ProjectUpgradeFactory',
        'Gear\Upgrade\Composer\ComposerUpgrade' => 'Gear\Upgrade\Composer\ComposerUpgradeFactory',
        'Gear\Upgrade\Npm\NpmUpgrade' => 'Gear\Upgrade\Npm\NpmUpgradeFactory',
        'Gear\Upgrade\Ant\AntUpgrade' => 'Gear\Upgrade\Ant\AntUpgradeFactory',
        'Gear\Upgrade\Dir\DirUpgrade' => 'Gear\Upgrade\Dir\DirUpgradeFactory',
        'Gear\Upgrade\File\FileUpgrade' => 'Gear\Upgrade\File\FileUpgradeFactory',
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
        'Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixer' => 'Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixerFactory',
        'Gear\Mvc\Controller\Api\ApiControllerService' => 'Gear\Mvc\Controller\Api\ApiControllerServiceFactory',
        'Gear\Mvc\Controller\Api\ApiControllerTestService' => 'Gear\Mvc\Controller\Api\ApiControllerTestServiceFactory',
        'Gear\Docker\DockerService' => 'Gear\Docker\DockerServiceFactory',
        'Gear\Kube\KubeService' => 'Gear\Kube\KubeServiceFactory'
    ***REMOVED***,
    'shared' => [
        'Gear\Column\ColumnService' => false,
        'Gear\Generator\Code\UseStack' => false
    ***REMOVED***
***REMOVED***;
