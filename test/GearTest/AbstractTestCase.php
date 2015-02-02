<?php
namespace GearTest;

abstract class AbstractTestCase extends \PHPUnit_Framework_TestCase
{
    protected $serviceLocator;

    protected $boostrap;

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        $refl = new \ReflectionObject($this);
        foreach ($refl->getProperties() as $prop) {
            if (!$prop->isStatic() && 0 !== strpos($prop->getDeclaringClass()->getName(), 'PHPUnit_')) {
                $prop->setAccessible(true);
                $prop->setValue($this, null);
            }
        }
        unset($this->bootstrap);
        parent::tearDown();
    }



    /**
     * Simplifier Create Mocks for abstract class
     * @param string $name
     * @param array $functions
     * @return PHPUnit_Framework_MockObject_MockObject $abstractRepository
     */
    public function getMockAbstractClass($name, $functions = array())
    {
        if (count($functions)>0) {
            $abstractRepository = $this->getMockBuilder($name)
            ->disableOriginalConstructor()
            ->setMethods($functions)
            ->getMockForAbstractClass();

        } else {
            $abstractRepository = $this->getMockBuilder($name)
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();
        }

        return $abstractRepository;

    }

    /**
     * Simplifier Create Mocks for class
     * @param string $name
     * @param array $functions
     * @return PHPUnit_Framework_MockObject_MockObject $emMock
     */
    public function getMockSingleClass($name, $functions = array())
    {
        if (count($functions)>0) {
            $emMock = $this->getMockBuilder($name)
            ->disableOriginalConstructor()
            ->setMethods($functions)
            ->getMock();
        } else {
            $emMock = $this->getMockBuilder($name)
            ->disableOriginalConstructor()
            ->getMock();
        }

        return $emMock;

    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function setServiceLocator($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }
}