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
        $this->assertEquals($expects, $composer);
    }

    public function testAddNamespaceIntoComposer()
    {
        $namespace = $this->getBootstrap()->getServiceLocator()->get('Gear\Autoload\Namespaces');
        $newNamespace = 'MyNewModule';
        $newFolder    = '/module/MyNewModule/src';

        $namespace->setAutoloadFile(realpath(__DIR__.'/namespace-test/autoload_namespace.php'));

        $composer = $namespace->addNamespaceIntoComposer($newNamespace, $newFolder);
        $expects = file_get_contents(realpath(__DIR__.'/namespace-test/post-add.php'));
        $this->assertEquals($expects, $composer);
    }
/*




 */



}
