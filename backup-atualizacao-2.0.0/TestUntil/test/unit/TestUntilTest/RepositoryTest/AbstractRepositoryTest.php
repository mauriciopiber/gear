<?php
namespace TestUntil\TestUntilTest\RepositoryTest;

class AbstractRepositoryTest extends \PHPUnit_Framework_TestCase
{
    protected $pais;

    protected function setUp()
    {
        $this->bootstrap = new \TestUntil\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function testGetFactoryValueMoney()
    {
        $abstract = $this->getMockBuilder('TestUntil\Repository\AbstractRepository')
        ->disableOriginalConstructor()
        ->getMockForAbstractClass();

        $abstract->setEntityManager($this->bootstrap->getEntityManager());

        $this->assertEquals('20.00',$abstract->factory('money', 'R$ 20,00'));
    }

    public function testGetFactoryValueInexist()
    {
        $abstract = $this->getMockBuilder('TestUntil\Repository\AbstractRepository')
        ->disableOriginalConstructor()
        ->getMockForAbstractClass();

        $abstract->setEntityManager($this->bootstrap->getEntityManager());

        $this->setExpectedException('Exception');

        $abstract->factory('nonExisting', '21/09/1990');

    }

    public function testGetFactoryValueDate()
    {
        $abstract = $this->getMockBuilder('TestUntil\Repository\AbstractRepository')
        ->disableOriginalConstructor()
        ->getMockForAbstractClass();

        $abstract->setEntityManager($this->bootstrap->getEntityManager());

        $this->assertEquals('1990-09-21',$abstract->factory('date', '21/09/1990'));

    }

    public function testGetOrderByMapNotExistReturnException()
    {
        $abstractRepository = $this->getMockBuilder('TestUntil\Repository\AbstractRepository')
          ->disableOriginalConstructor()
          ->getMockForAbstractClass();
    }

    public function testSetUpBetween()
    {
        $abstractRepository = $this->getMockBuilder('TestUntil\Repository\AbstractRepository')
        ->disableOriginalConstructor()
        ->setMethods(array('getMapReferences', 'getAliase', 'getRepository'))
        ->getMockForAbstractClass();


        $abstractRepository->setEntityManager($this->bootstrap->getEntityManager());
        $abstractRepository->expects($this->any())
        ->method('getMapReferences')
        ->willReturn(array(
        	'preco' => array('type' => 'money'),
            'data'  => array('type' => 'money')
        ));

        $abstractRepository->expects($this->any())
        ->method('getAliase')
        ->willReturn('u');

        $abstractRepository->expects($this->any())
        ->method('getRepository')
        ->willReturn($this->bootstrap->getEntityManager()->getRepository('TestUntil\Entity\Pais'));

        $abstractRepository->setQuery($abstractRepository->getRepository()->createQueryBuilder($abstractRepository->getAliase()));


        $abstractRepository->setFilter(array(
            'precoPre' => '25.00',
            'precoPos' => '50.00',
            'dataPre'  => '75.00',
            'dataPos'  => '100.00'
        ));

        $abstractRepository->setUpBetween();
        $query = $abstractRepository->getQuery();
        $this->assertEquals('(u.preco BETWEEN :precopre1 AND :precopos1) AND (u.data BETWEEN :datapre2 AND :datapos2)', (string) $query->getDqlPart('where'));
        $filter = $abstractRepository->getFilter();
        $this->assertEquals(array(), $filter);

    }

    public function testSetUpBetweenFrom()
    {
        $abstractRepository = $this->getMockBuilder('TestUntil\Repository\AbstractRepository')
        ->disableOriginalConstructor()
        ->setMethods(array('getMapReferences', 'getAliase', 'getRepository'))
        ->getMockForAbstractClass();


        $abstractRepository->setEntityManager($this->bootstrap->getEntityManager());
        $abstractRepository->expects($this->any())
        ->method('getMapReferences')
        ->willReturn(array(
            'preco' => array('type' => 'money')
        ));

        $abstractRepository->expects($this->any())
        ->method('getAliase')
        ->willReturn('u');

        $abstractRepository->expects($this->any())
        ->method('getRepository')
        ->willReturn($this->bootstrap->getEntityManager()->getRepository('TestUntil\Entity\Pais'));

        $abstractRepository->setQuery($abstractRepository->getRepository()->createQueryBuilder($abstractRepository->getAliase()));


        $abstractRepository->setFilter(array(
            'precoPre' => '25.00',
            'precoPos' => ''
        ));

        $abstractRepository->setUpBetween();
        $query = $abstractRepository->getQuery();
        $this->assertEquals('u.preco >= :precopre1', (string) $query->getDqlPart('where'));
        $filter = $abstractRepository->getFilter();
        $this->assertEquals(array(), $filter);
    }



    public function testSetUpBetweenTo()
    {
        $abstractRepository = $this->getMockBuilder('TestUntil\Repository\AbstractRepository')
        ->disableOriginalConstructor()
        ->setMethods(array('getMapReferences', 'getAliase', 'getRepository'))
        ->getMockForAbstractClass();


        $abstractRepository->setEntityManager($this->bootstrap->getEntityManager());
        $abstractRepository->expects($this->any())
        ->method('getMapReferences')
        ->willReturn(array(
            'preco' => array('type' => 'money')
        ));

        $abstractRepository->expects($this->any())
        ->method('getAliase')
        ->willReturn('u');

        $abstractRepository->expects($this->any())
        ->method('getRepository')
        ->willReturn($this->bootstrap->getEntityManager()->getRepository('TestUntil\Entity\Pais'));

        $abstractRepository->setQuery($abstractRepository->getRepository()->createQueryBuilder($abstractRepository->getAliase()));


        $abstractRepository->setFilter(array(
            'precoPre' => '',
            'precoPos' => '50.00'
        ));

        $abstractRepository->setUpBetween();
        $query = $abstractRepository->getQuery();
        $this->assertEquals('u.preco <= :precopos1', (string) $query->getDqlPart('where'));
        $filter = $abstractRepository->getFilter();
        $this->assertEquals(array(), $filter);
    }

    public function testSetUpWhere()
    {
        $abstractRepository = $this->getMockBuilder('TestUntil\Repository\AbstractRepository')
        ->disableOriginalConstructor()
        ->setMethods(array('getMapReferences', 'getAliase', 'getRepository'))
        ->getMockForAbstractClass();


        $abstractRepository->setEntityManager($this->bootstrap->getEntityManager());
        $abstractRepository->expects($this->any())
        ->method('getMapReferences')
        ->willReturn(array(
            'preco' => array('type' => 'money')
        ));

        $abstractRepository->expects($this->any())
        ->method('getAliase')
        ->willReturn('u');

        $abstractRepository->expects($this->any())
        ->method('getRepository')
        ->willReturn($this->bootstrap->getEntityManager()->getRepository('TestUntil\Entity\Pais'));

        $abstractRepository->setQuery($abstractRepository->getRepository()->createQueryBuilder($abstractRepository->getAliase()));


        $abstractRepository->setFilter(array(
            'teste' => 'meuvalorasertestado',
            'testedois' => 'meusegundovalorasertestado'
        ));

        $abstractRepository->setUpWhere();
    }

    public function testSetUpJoin()
    {
        $abstractRepository = $this->getMockBuilder('TestUntil\Repository\AbstractRepository')
        ->disableOriginalConstructor()
        ->setMethods(array('getMapReferences', 'getAliase', 'getRepository'))
        ->getMockForAbstractClass();


        $abstractRepository->setEntityManager($this->bootstrap->getEntityManager());
        $abstractRepository->expects($this->any())
        ->method('getMapReferences')
        ->willReturn(array(
            'preco' => array('type' => 'join', 'aliase' => 'p'),
            'escola' => array('type' => 'join', 'aliase' => 'e')
        ));

        $abstractRepository->expects($this->any())
        ->method('getAliase')
        ->willReturn('u');

        $abstractRepository->expects($this->any())
        ->method('getRepository')
        ->willReturn($this->bootstrap->getEntityManager()->getRepository('TestUntil\Entity\Pais'));

        $abstractRepository->setQuery($abstractRepository->getRepository()->createQueryBuilder($abstractRepository->getAliase()));


        $abstractRepository->setFilter(array(
            'preco' => 'meuvalorasertestado',
        ));

        $abstractRepository->setUpJoin();
    }

    public function testGerOrderedByMapNoexisting()
    {
        $abstractRepository = $this->getMockBuilder('TestUntil\Repository\AbstractRepository')
        ->disableOriginalConstructor()
        ->setMethods(array('getMapReferences'))
        ->getMockForAbstractClass();

        $abstractRepository->setEntityManager($this->bootstrap->getEntityManager());
        $abstractRepository->expects($this->any())
        ->method('getMapReferences')
        ->willReturn(array(
            'preco' => array('type' => 'money')
        ));

        $this->setExpectedException('Exception');

        $abstractRepository->getOrderByMap('exception');
    }
}
