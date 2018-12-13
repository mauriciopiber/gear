<?php
namespace GearTest\CreatorTest;

use PHPUnit\Framework\TestCase;
use Gear\Creator\ClassDependencyObject;

class ClassDependencyObjectTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->module = 'Module';
    }

    public function dependencyData()
    {
        return [
            [
                'Repository\Dependency',
                'Dependency',
                'Module\Repository',
                'Module\Repository\Dependency',
                'Dependency',
                'Module\Repository\Dependency',
                1
            ***REMOVED***,
            [
                [
                    'class' => 'Repository\Dependency'
                ***REMOVED***,
                'Dependency',
                'Module\Repository',
                'Module\Repository\Dependency',
                'Dependency',
                'Module\Repository\Dependency',
                3
            ***REMOVED***,
            [
                [
                    'class' => 'Repository\Dependency',
                    'aliase' => 'RepositoryDependency'
                ***REMOVED***,
                'Dependency',
                'Module\Repository',
                'Module\Repository\Dependency',
                'RepositoryDependency',
                'RepositoryDependency',
                4
            ***REMOVED***,
            [
                [
                    'class' => 'Repository\Dependency',
                ***REMOVED***,
                'Dependency',
                'Module\Repository',
                'Module\Repository\Dependency',
                'RepositoryDependency',
                'RepositoryDependency',
                'RepositoryDependency'
            ***REMOVED***
        ***REMOVED***;
        // [['Repository\Dependency'***REMOVED***, 'Dependency, 'Repository', 'Dependency'***REMOVED***;
        
    }

    /**
     * @dataProvider dependencyData
     */
    public function testClassDependencyObject($data, $name, $namespace, $fullName, $varName, $serviceManager, $index)
    {
        $classDependencyObject = new ClassDependencyObject($data, $this->module, $index);
        $this->assertEquals($name, $classDependencyObject->getName());
        $this->assertEquals($namespace, $classDependencyObject->getNamespace());
        $this->assertEquals($fullName, $classDependencyObject->getFullName());
        $this->assertEquals($varName, $classDependencyObject->getVar());
        // $this->assertEquals($localName, $classDependencyObject->getLocalName());
        $this->assertEquals($serviceManager, $classDependencyObject->getServiceManager());
    }
}
