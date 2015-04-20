<?php
namespace GearTest\AutoloadTest;

class NamespacesTest extends \GearBaseTest\AbstractTestCase
{
    public function testSetAutoloadFile()
    {
        $namespace = $this->getBootstrap()->getServiceLocator()->get('Gear\Autoload\Namespaces');
        $namespace->setAutoloadFile(realpath(__DIR__.'/namespace-test/autoload_namespace.php'));
        $this->assertEquals(realpath(__DIR__.'/namespace-test/autoload_namespace.php'), $namespace->getAutoloadFile());
        $this->assertFileExists($namespace->getAutoloadFile());
    }

    public function testGetAutoloadFile()
    {
        $namespace = $this->getBootstrap()->getServiceLocator()->get('Gear\Autoload\Namespaces');
        $this->assertEquals(\GearBase\Module::getProjectFolder().'/vendor/composer/autoload_namespaces.php', $namespace->getAutoloadFile());
    }

    public function testGetAutoloadNamespaceFile()
    {
        $namespace = $this->getBootstrap()->getServiceLocator()->get('Gear\Autoload\Namespaces');
        $newNamespace = 'MyNewNamespace';


        $namespace->setAutoloadFile(realpath(__DIR__.'/namespace-test/autoload_namespace.php'));
        $composer = $namespace->getAutoloaderContents();

        $expects = file_get_contents(realpath(__DIR__.'/namespace-test/autoload_namespace.php'));

        $this->assertEquals($expects, $composer);
    }


    public function testDeleteNamespaceFromComposer()
    {
        $namespace = $this->getBootstrap()->getServiceLocator()->get('Gear\Autoload\Namespaces');
        $newNamespace = 'GearTest';
        $composer = $namespace->deleteNamespaceFromComposer($newNamespace);
        $expects = file_get_contents(realpath(__DIR__.'/namespace-test/post-delete.php'));
        $this->assertEquals($expects, $composer->getContents());
    }

    public function testAddNamespaceIntoComposer()
    {
        $namespace = $this->getBootstrap()->getServiceLocator()->get('Gear\Autoload\Namespaces');
        $newNamespace = 'MyNewModule';
        $newFolder    = '/module/MyNewModule/src';

        $namespace->setAutoloadFile(realpath(__DIR__.'/namespace-test/autoload_namespace.php'));

        $composer = $namespace->addNamespaceIntoComposer($newNamespace, $newFolder);
        $expects = file_get_contents(realpath(__DIR__.'/namespace-test/post-add.php'));
        $this->assertEquals($expects, $composer->getContents());
    }

    public function testAddMultiplesNamespaceBeforeWrite()
    {
        $namespace = $this->getBootstrap()->getServiceLocator()->get('Gear\Autoload\Namespaces');
        $namespace->setAutoloadFile(realpath(__DIR__.'/namespace-test/autoload_namespace.php'));

        $composer = $namespace->addNamespaceIntoComposer('NamespaceUm', '/module/NamespaceUm/src')
          ->addNamespaceIntoComposer('NamespaceDois', '/module/NamespaceDois/src')
          ->addNamespaceIntoComposer('NamespaceTres', '/module/NamespaceTres/test/unit')
          ->addNamespaceIntoComposer('NamespaceQuatro', '/module/NamespaceQuatro/src')
          ->addNamespaceIntoComposer('NamespaceCinco', '/module/NamespaceCinco/test/unit');

        $expect = file_get_contents(realpath(__DIR__.'/namespace-test/multiple-add.php'));

        $this->assertEquals($expect, $composer->getContents());
    }

    /**
     * @group unique
     */

    public function testMultipleDeleteBeforeWrite()
    {
        $namespace = $this->getBootstrap()->getServiceLocator()->get('Gear\Autoload\Namespaces');
        $namespace->setAutoloadFile(realpath(__DIR__.'/namespace-test/autoload_namespace.php'));

        $composer = $namespace->deleteNamespaceFromComposer('AssetManager')
        ->deleteNamespaceFromComposer('Doctrine\\\\Common\\\\Collections\\\\');

        $expect = file_get_contents(realpath(__DIR__.'/namespace-test/multiple-delete.php'));

        $this->assertEquals($expect, $composer->getContents());
    }

    public function testNamespaceExists()
    {
        $namespace = $this->getBootstrap()->getServiceLocator()->get('Gear\Autoload\Namespaces');
        $namespace->setAutoloadFile(realpath(__DIR__.'/namespace-test/autoload_namespace.php'));

        $this->assertTrue($namespace->checkNamespaceExists('GearTest'));
        $this->assertFalse($namespace->checkNamespaceExists('GearTesting'));

        $this->assertTrue($namespace->checkNamespaceExists('GearTest'));
        $this->assertFalse($namespace->checkNamespaceExists('GearTesting'));

        $this->assertTrue($namespace->checkNamespaceExists('Symfony\\\\Component\\\\DependencyInjection\\\\'));
        $this->assertFalse($namespace->checkNamespaceExists('Symfony\\Component\\DependencyInjection\\'));
    }

    public function testAddAndDeleteBeforeWrite()
    {
        $namespace = $this->getBootstrap()->getServiceLocator()->get('Gear\Autoload\Namespaces');
        $namespace->setAutoloadFile(realpath(__DIR__.'/namespace-test/autoload_namespace.php'));

        $composer = $namespace->addNamespaceIntoComposer('NamespaceUm', '/module/NamespaceUm/src')
        ->deleteNamespaceFromComposer('GearTest');


        $expect = file_get_contents(realpath(__DIR__.'/namespace-test/add-delete.php'));

        $this->assertEquals($expect, $composer->getContents());

    }

    public function testExtractContaints()
    {
        $namespace = $this->getBootstrap()->getServiceLocator()->get('Gear\Autoload\Namespaces');
        $contents = $namespace->setAutoloadFile(realpath(__DIR__.'/namespace-test/post-delete.php'))->extractContents()->getContents();

        $expect = file_get_contents(realpath(__DIR__.'/namespace-test/post-delete.php'));

        $this->assertEquals($expect, $contents);
    }

    public function testWriteFile()
    {
        $namespace = $this->getBootstrap()->getServiceLocator()->get('Gear\Autoload\Namespaces');

        $overwrite = __DIR__.'/namespace-test/write-overwrite.php';
        if (is_file($overwrite)) {
            unlink($overwrite);
        }

        $file = realpath(__DIR__.'/namespace-test/write-standard.php');

        $namespace = $namespace->setAutoloadFile($file)->extractContents()->setAutoloadFile($overwrite);
        $namespace->write();

        $contentsOverwrite = file_get_contents($overwrite);
        $contentsStandard  = file_get_contents($file);

        $this->assertEquals($contentsOverwrite, $contentsStandard);
    }
}
