
        $template       = new \Gear\Creator\Template\TemplateService    ();
        $template->setRenderer($phpRenderer);

        $fileService    = new \GearBase\Util\File\FileService();
        $this->stringService  = new \GearBase\Util\String\StringService();
        $this->fileCreator    = new \Gear\Creator\FileCreator\FileCreator($fileService, $template);

        $this->dirService = new \GearBase\Util\Dir\DirService();
        $this->stringService = new \GearBase\Util\String\StringService();


        $this->composer = $this->prophesize('Gear\Module\ComposerService');
        $this->testService = $this->prophesize('Gear\Module\TestService');

        $this->schema = $this->prophesize('GearJson\Schema\SchemaService');

        $this->schemaLoader = $this->prophesize('GearJson\Schema\Loader\SchemaLoaderService');

        $this->schemaController = $this->prophesize('GearJson\Controller\ControllerService');

        $this->schemaAction = $this->prophesize('GearJson\Action\ActionService');

        $this->consoleControllerTest = $this->prophesize('Gear\Mvc\ConsoleController\ConsoleControllerTest');

        $this->consoleController = $this->prophesize('Gear\Mvc\ConsoleController\ConsoleController');

        $this->controllerTest = $this->prophesize('Gear\Mvc\Controller\ControllerTestService');

        $this->controller = $this->prophesize('Gear\Mvc\Controller\ControllerService');

        $this->codeception = $this->prophesize('Gear\Module\CodeceptionService');

        $this->configService = $this->prophesize('Gear\Mvc\Config\ConfigService');

        $this->languageService = $this->prophesize('Gear\Mvc\LanguageService');

        $this->appController = $this->prophesize('Gear\Mvc\View\App\AppControllerService');

        $this->appControllerSpec = $this->prophesize('Gear\Mvc\View\App\AppControllerSpecService');

        $this->viewService = $this->prophesize('Gear\Mvc\View\ViewService');

        $this->gulpfile = $this->prophesize('Gear\Module\Node\Gulpfile');

        $this->package = $this->prophesize('Gear\Module\Node\Package');

        $this->karma = $this->prophesize('Gear\Module\Node\Karma');

        $this->protractor = $this->prophesize('Gear\Module\Node\Protractor');

        $this->docs = $this->prophesize('Gear\Module\Docs\Docs');

        $this->dir = new \GearBase\Util\Dir\DirService();

        $this->feature = $this->prophesize('Gear\Mvc\Spec\Feature\Feature');

        $this->unitTest = $this->prophesize('Gear\Mvc\Spec\UnitTest\UnitTest');

        $this->page = $this->prophesize('Gear\Mvc\Spec\Page\Page');

        $this->step = $this->prophesize('Gear\Mvc\Spec\Step\Step');

        $this->view = $this->prophesize('Gear\Mvc\View\ViewService');

        $this->cache = $this->prophesize('Gear\Cache\CacheService');

        $this->request = $this->prophesize('Zend\Console\Request');

        $this->applicationConfig = $this->prophesize('Gear\Module\Config\ApplicationConfig');

        $this->autoload = $this->prophesize('Gear\Autoload\ComposerAutoload');