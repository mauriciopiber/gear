<?php
namespace TesteTest\RepositoryTest;

/**
 * @group Repository
 */
class AbstractRepositoryTest extends \TesteTest\AbstractTest
{

    protected $pais;
    /**
     * @cover Teste\Repository\AbstractRepository::getHydratorObject
     */
    public function testGetSecurityHydrator()
    {
        $abstractRepository = $this->getMockAbstractClass('Teste\Repository\AbstractRepository');

        $entityManagerMock = $this->getMockSingleClass('Doctrine\ORM\EntityManager');

        $abstractRepository->setEntityManager($entityManagerMock);

        $this->assertInstanceOf('Security\Hydrator\DateHydrator', $abstractRepository->getSecurityHydrator());
    }

    public function testGetDoctrineHydrator()
    {
        $abstractRepository = $this->getMockAbstractClass('Teste\Repository\AbstractRepository');

        $entityManagerMock = $this->getMockSingleClass('Doctrine\ORM\EntityManager');

        $abstractRepository->setEntityManager($entityManagerMock);

        $this->assertInstanceOf(
            'DoctrineModule\Stdlib\Hydrator\DoctrineObject',
            $abstractRepository->getDoctrineHydrator()
        );
    }


    public function testSelectAllWithFilter()
    {
        $abstractRepository = $this->getMockAbstractClass('Teste\Repository\AbstractRepository', array(
            'getSelect',
            'getRepositoryName',
            'setUpJoin',
            'getAliase',
            'getMapReference'
        ));
        $abstractRepository->setEntityManager($this->bootstrap->getEntityManager());

        $abstractRepository->expects($this->any())
            ->method('getSelect')
            ->willReturn('a');

        $abstractRepository->expects($this->any())
            ->method('getAliase')
            ->willReturn('a');

        $abstractRepository->expects($this->any())
            ->method('getRepositoryName')
            ->willReturn('Security\Entity\User');

        $abstractRepository->expects($this->any())
            ->method('setUpJoin')
            ->willReturn(true);

        $abstractRepository->expects($this->any())
            ->method('getMapReferences')
            ->willReturn(
                array(
                    'email' => array(
                        'type' => 'join',
                        'ref' => 'a.email'
                    )
                )
            );

        $data = array_pop($abstractRepository->selectAll(array(
            'likeField' => 'usuariogear1@gmail.com'
        )));

        $this->assertEquals($data['email'***REMOVED***, 'usuariogear1@gmail.com');
    }

    public function testSelectAll()
    {
        $abstractRepository = $this->getMockAbstractClass('Teste\Repository\AbstractRepository', array(
            'getSelect',
            'getRepositoryName',
            'setUpJoin',
            'getAliase'
        ));
        $abstractRepository->setEntityManager($this->bootstrap->getEntityManager());

        $abstractRepository->expects($this->any())
            ->method('getSelect')
            ->willReturn('a');

        $abstractRepository->expects($this->any())
            ->method('getAliase')
            ->willReturn('a');

        $abstractRepository->expects($this->any())
            ->method('getRepositoryName')
            ->willReturn('Security\Entity\User');

        $abstractRepository->expects($this->any())
            ->method('setUpJoin')
            ->willReturn(true);

        $data = array_pop($abstractRepository->selectAll(array(
            'email' => 'usuariogear1@gmail.com'
        )));

        $this->assertEquals($data['email'***REMOVED***, 'usuariogear1@gmail.com');
    }

    public function testGetOrderBy()
    {
        $abstractRepository = $this->getMockAbstractClass('Teste\Repository\AbstractRepository');
        $this->assertNull($abstractRepository->getOrderBy());
    }

    public function testGetOrder()
    {
        $abstractRepository = $this->getMockAbstractClass('Teste\Repository\AbstractRepository');
        $this->assertNull($abstractRepository->getOrder());
    }

    public function testPersist()
    {
        $abstractRepository = $this->getMockAbstractClass('Teste\Repository\AbstractRepository');

        $emMock = $this->getMockSingleClass('Doctrine\ORM\EntityManager', array(
            'persist',
            'flush'
        ));

        $abstractRepository->setEntityManager($emMock);

        $this->assertTrue($abstractRepository->persist(null));
    }

    public function testGetRepository()
    {
        $abstractRepository = $this->getMockAbstractClass('Teste\Repository\AbstractRepository');

        $emMock = $this->getMockSingleClass('Doctrine\ORM\EntityManager', array(
            'getRepository'
        ));

        $emMock->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue(null));

        $abstractRepository->setEntityManager($emMock);

        $this->assertEquals(null, $abstractRepository->getRepository());
    }

    public function testFilterHasLike()
    {
        $abstractRepository = $this->getMockAbstractClass('Teste\Repository\AbstractRepository');

        $abstractRepository->setFilter(array());

        $this->assertFalse($abstractRepository->hasLikeFilter());
    }

    public function testHasntHasLikeFilter()
    {
        $abstractRepository = $this->getMockAbstractClass('Teste\Repository\AbstractRepository');

        $abstractRepository->setFilter(array(
            'likeField' => 'testandolegal'
        ));

        $this->assertTrue($abstractRepository->hasLikeFilter());
    }

    public function testGetSelect()
    {
        $abstractRepository = $this->getMockAbstractClass('Teste\Repository\AbstractRepository', array(
            'getMapReferences'
        ));
        $abstractRepository->setEntityManager($this->bootstrap->getEntityManager());
        $abstractRepository->expects($this->any())
            ->method('getMapReferences')
            ->willReturn(array(
                'preco' => array(
                    'type' => 'join',
                    'aliase' => 'a'
                ),
                'data' => array(
                    'type' => 'join',
                    'aliase' => 'b'
                ),
                'another' => array(
                    'type' => 'primary',
                    'aliase' => 'c'
                )
            ));

        $this->assertEquals('a,b,c', $abstractRepository->getSelect());
    }

    public function testSetUpLike()
    {
        $abstractRepository = $this->getMockAbstractClass('Teste\Repository\AbstractRepository', array(
            'getMapReferences',
            'getRepository'
        ));
        $abstractRepository->setEntityManager($this->bootstrap->getEntityManager());
        $abstractRepository->expects($this->any())
            ->method('getMapReferences')
            ->willReturn(array(
                'preco' => array(
                    'type' => 'join',
                    'ref' => 'minhaRefUm'
                ),
                'data' => array(
                    'type' => 'join',
                    'ref' => 'minhaRefDois'
                ),
                'another' => array(
                    'type' => 'primary',
                    'ref' => 'minhaRefTres'
                )
            ));

        $abstractRepository->expects($this->any())
            ->method('getRepository')
            ->willReturn($this->bootstrap->getEntityManager()
            ->getRepository('Teste\Entity\User'));

        $abstractRepository->setQuery($abstractRepository->getRepository()
            ->createQueryBuilder($abstractRepository->getAliase()));

        $abstractRepository->setFilter(array(
            'likeField' => 'referencia'
        ));

        $abstractRepository->setUpLike();
        $query = $abstractRepository->getQuery();

        $expects = 'minhaRefUm LIKE ?1 OR minhaRefDois LIKE ?1 OR minhaRefTres LIKE ?1';
        $this->assertEquals($expects, (string) $query->getDqlPart('where'));
    }

    public function testSelectOneBy()
    {
        $abstractRepository = $this->getMockAbstractClass('Teste\Repository\AbstractRepository', array(
            'getRepository'
        ));
        $abstractRepository->setEntityManager($this->bootstrap->getEntityManager());

        $abstractRepository->expects($this->any())
            ->method('getRepository')
            ->willReturn($this->bootstrap->getEntityManager()
            ->getRepository('Teste\Entity\User'));

        $user = $abstractRepository->selectOneBy(array(
            'email' => 'usuariogear1@gmail.com'
        ));

        $this->assertInstanceOf('Teste\Entity\User', $user);
        $this->assertEquals('usuariogear1@gmail.com', $user->getEmail());
    }

    public function testDeleteByEntity()
    {
        $abstractRepository = $this->getMockAbstractClass('Teste\Repository\AbstractRepository');

        $emMock = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->setMethods(array(
                'remove',
                'flush'
            ))->getMock();

        $abstractRepository->setServiceLocator($this->bootstrap->getServiceLocator());
        $abstractRepository->setEntityManager($emMock);

        $mockEntity = $this->getMockSingleClass('Security\Entity\User');

        $this->assertTrue($abstractRepository->delete($mockEntity));
    }

    public function testHydrate()
    {
        $abstractRepository = $this->getMockAbstractClass('Teste\Repository\AbstractRepository', array(
            'getSecurityHydrator'
        ));


        $mockObjectHydrator = $this->getMockSingleClass('Security\Hydrator\DateHydrator', array(
            'hydrate',
            'extract'
        ));

        $mockObjectHydrator->expects($this->any())
            ->method('hydrate')
            ->will($this->returnValue($this->getUserByEmail('usuariogear1@gmail.com')));

        $mockObjectHydrator->expects($this->any())
            ->method('extract')
            ->will($this->returnValue(array()));

        $abstractRepository->expects($this->any())
            ->method('getSecurityHydrator')
            ->will($this->returnValue($mockObjectHydrator));

        $user = new \Security\Entity\User();

        $abstractRepository->hydrate(array(
            'email' => 'usuariogear1@gmail.com'
        ), $user);
    }

    public function testGetUser()
    {
        $this->getMockIdentifier();

        $abstractRepository = $this->getMockAbstractClass('Teste\Repository\AbstractRepository', array(
            'getDoctrineHydrator'
        ));

        $emMock = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->setMethods(array(
                'persist',
                'flush'
            ))->getMock();

        $abstractRepository->setServiceLocator($this->bootstrap->getServiceLocator());
        $abstractRepository->setEntityManager($emMock);

        $mockObjectHydrator = $this->getMockSingleClass('DoctrineModule\Stdlib\Hydrator\DoctrineObject', array(
            'hydrate',
            'extract'
        ));

        $mockObjectHydrator->expects($this->any())
            ->method('hydrate')
            ->will($this->returnValue($this->getUserByEmail('usuariogear1@gmail.com')));

        $mockObjectHydrator->expects($this->any())
            ->method('extract')
            ->will($this->returnValue(array()));

        $abstractRepository->expects($this->any())
            ->method('getDoctrineHydrator')
            ->will($this->returnValue($mockObjectHydrator));

        $user = $abstractRepository->getUser();

        $this->assertInstanceOf('Security\Entity\User', $user);
        $this->assertEquals('usuariogear1@gmail.com', $user->getEmail());
    }

    public function testExtract()
    {
        $abstractRepository = $this->getMockAbstractClass('Teste\Repository\AbstractRepository');
        $abstractRepository->setEntityManager($this->bootstrap->getEntityManager());

        $data = $abstractRepository->extract($this->getUserByEmail('usuariogear1@gmail.com'));

        $this->assertEquals('1', $data['idUser'***REMOVED***);
        $this->assertEquals('usuariogear1@gmail.com', $data['email'***REMOVED***);
    }

    public function testDeleteNull()
    {
        $abstractRepository = $this->getMockAbstractClass('Teste\Repository\AbstractRepository', array(
            'delete'
        ));

        $abstractRepository->expects($this->any())
            ->method('delete')
            ->willReturn(false);

        $emMock = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->setMethods(array(
                'remove',
                'flush'
            ))->getMock();

        $abstractRepository->setServiceLocator($this->bootstrap->getServiceLocator());
        $abstractRepository->setEntityManager($emMock);

        $this->assertFalse($abstractRepository->delete(1));
    }

    public function testSetUpOrder()
    {
        $abstractRepository = $this->getMockAbstractClass('Teste\Repository\AbstractRepository', array(
            'getOrderByMap',
            'getRepository'
        ));

        $abstractRepository->setEntityManager($this->bootstrap->getEntityManager());
        $abstractRepository->expects($this->any())
            ->method('getOrderByMap')
            ->willReturn('mymappingby');

        $abstractRepository->expects($this->any())
            ->method('getRepository')
            ->willReturn($this->bootstrap->getEntityManager()
            ->getRepository('Teste\Entity\User'));

        $abstractRepository->setQuery($abstractRepository->getRepository()
            ->createQueryBuilder($abstractRepository->getAliase()));

        $abstractRepository->setOrderBy('mymappingby');
        $abstractRepository->setOrder('ASC');

        $abstractRepository->setUpOrder();
        $query = $abstractRepository->getQuery();
        $orderBy = array_pop($query->getDqlPart('orderBy'));
        $this->assertEquals(array(
            'mymappingby ASC'
        ), $orderBy->getParts());
    }

    public function testGetOrderByMap()
    {
        $abstractRepository = $this->getMockAbstractClass('Teste\Repository\AbstractRepository', array(
            'getMapReferences'
        ));

        $abstractRepository->setEntityManager($this->bootstrap->getEntityManager());
        $abstractRepository->expects($this->any())
            ->method('getMapReferences')
            ->willReturn(array(
                'preco' => array(
                    'type' => 'money',
                    'ref' => '123'
                ),
                'data' => array(
                    'type' => 'money',
                    'ref' => '456'
                )
            ));

        $orderBy = $abstractRepository->getOrderByMap('preco');

        $this->assertEquals($orderBy, '123');

        $orderBy = $abstractRepository->getOrderByMap('data');

        $this->assertEquals($orderBy, '456');
    }

    public function testGetEntityManager()
    {
        $abstractRepository = $this->getMockAbstractClass('Teste\Repository\AbstractRepository');

        $abstractRepository->setServiceLocator($this->bootstrap->getServiceLocator());

        $abstractRepository->setEntityManager(null);

        $this->assertInstanceOf('Doctrine\ORM\EntityManager', $abstractRepository->getEntityManager());
    }

    public function testGetFactoryValueMoney()
    {
        $abstractRepository = $this->getMockAbstractClass('Teste\Repository\AbstractRepository');

        $abstractRepository->setEntityManager($this->bootstrap->getEntityManager());

        $this->assertEquals('20.00', $abstractRepository->factory('money', 'R$ 20,00'));
    }

    public function testGetFactoryValueInexist()
    {
        $abstractRepository = $this->getMockAbstractClass('Teste\Repository\AbstractRepository');

        $abstractRepository->setEntityManager($this->bootstrap->getEntityManager());

        $this->setExpectedException('Exception');

        $abstractRepository->factory('nonExisting', '21/09/1990');
    }

    public function testGetFactoryValueDate()
    {
        $abstractRepository = $this->getMockAbstractClass('Teste\Repository\AbstractRepository');

        $abstractRepository->setEntityManager($this->bootstrap->getEntityManager());

        $this->assertEquals('1990-09-21', $abstractRepository->factory('date', '21/09/1990'));
    }

    public function testSetUpBetween()
    {
        $abstractRepository = $this->getMockAbstractClass('Teste\Repository\AbstractRepository', array(
            'getMapReferences',
            'getAliase',
            'getRepository'
        ));

        $abstractRepository->setEntityManager($this->bootstrap->getEntityManager());
        $abstractRepository->expects($this->any())
            ->method('getMapReferences')
            ->willReturn(array(
                'preco' => array(
                    'type' => 'money'
                ),
                'data' => array(
                    'type' => 'money'
                )
            ));

        $abstractRepository->expects($this->any())
            ->method('getAliase')
            ->willReturn('u');

        $abstractRepository->expects($this->any())
            ->method('getRepository')
            ->willReturn($this->bootstrap->getEntityManager()
            ->getRepository('Teste\Entity\User'));

        $abstractRepository->setQuery($abstractRepository->getRepository()
            ->createQueryBuilder($abstractRepository->getAliase()));

        $abstractRepository->setFilter(array(
            'precoPre' => '25.00',
            'precoPos' => '50.00',
            'dataPre' => '75.00',
            'dataPos' => '100.00'
        ));

        $abstractRepository->setUpBetween();
        $query = $abstractRepository->getQuery();
        $expects = '(u.preco BETWEEN :precopre1 AND :precopos1) AND (u.data BETWEEN :datapre2 AND :datapos2)';
        $this->assertEquals($expects, (string) $query->getDqlPart('where'));
        $filter = $abstractRepository->getFilter();
        $this->assertEquals(array(), $filter);
    }

    public function testSetUpBetweenFrom()
    {
        $abstractRepository = $this->getMockAbstractClass('Teste\Repository\AbstractRepository', array(
            'getMapReferences',
            'getAliase',
            'getRepository'
        ));


        $abstractRepository->setEntityManager($this->bootstrap->getEntityManager());
        $abstractRepository->expects($this->any())
            ->method('getMapReferences')
            ->willReturn(array(
                'preco' => array(
                    'type' => 'money'
                )
            ));

        $abstractRepository->expects($this->any())
            ->method('getAliase')
            ->willReturn('u');

        $abstractRepository->expects($this->any())
            ->method('getRepository')
            ->willReturn($this->bootstrap->getEntityManager()
            ->getRepository('Teste\Entity\User'));

        $abstractRepository->setQuery($abstractRepository->getRepository()
            ->createQueryBuilder($abstractRepository->getAliase()));

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
        $abstractRepository = $this->getMockAbstractClass('Teste\Repository\AbstractRepository', array(
            'getMapReferences',
            'getAliase',
            'getRepository'
        ));

        $abstractRepository->setEntityManager($this->bootstrap->getEntityManager());
        $abstractRepository->expects($this->any())
            ->method('getMapReferences')
            ->willReturn(array(
                'preco' => array(
                    'type' => 'money'
                )
            ));

        $abstractRepository->expects($this->any())
            ->method('getAliase')
            ->willReturn('u');

        $abstractRepository->expects($this->any())
            ->method('getRepository')
            ->willReturn($this->bootstrap->getEntityManager()
            ->getRepository('Teste\Entity\User'));

        $abstractRepository->setQuery($abstractRepository->getRepository()
            ->createQueryBuilder($abstractRepository->getAliase()));

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
        $abstractRepository = $this->getMockAbstractClass('Teste\Repository\AbstractRepository', array(
            'getMapReferences',
            'getAliase',
            'getRepository'
        ));

        $abstractRepository->setEntityManager($this->bootstrap->getEntityManager());
        $abstractRepository->expects($this->any())
            ->method('getMapReferences')
            ->willReturn(
                array(
                    'preco' => array(
                        'type' => 'money'
                    )
                )
            );

        $abstractRepository->expects($this->any())
            ->method('getAliase')
            ->willReturn('u');

        $abstractRepository->expects($this->any())
            ->method('getRepository')
            ->willReturn($this->bootstrap->getEntityManager()
            ->getRepository('Teste\Entity\User'));

        $abstractRepository->setQuery($abstractRepository->getRepository()
            ->createQueryBuilder($abstractRepository->getAliase()));

        $abstractRepository->setFilter(array(
            'teste' => 'meuvalorasertestado',
            'testedois' => 'meusegundovalorasertestado'
        ));

        $abstractRepository->setUpWhere();
    }

    public function testSetUpJoin()
    {
        $abstractRepository = $this->getMockAbstractClass('Teste\Repository\AbstractRepository', array(
            'getMapReferences',
            'getAliase',
            'getRepository'
        ));

        $abstractRepository->setEntityManager($this->bootstrap->getEntityManager());
        $abstractRepository->expects($this->any())
            ->method('getMapReferences')
            ->willReturn(
                array(
                    'preco' => array(
                        'type' => 'join',
                        'aliase' => 'p'
                    ),
                    'escola' => array(
                        'type' => 'join',
                        'aliase' => 'e'
                    )
                )
            );

        $abstractRepository->expects($this->any())
            ->method('getAliase')
            ->willReturn('u');

        $abstractRepository->expects($this->any())
            ->method('getRepository')
            ->willReturn($this->bootstrap->getEntityManager()
            ->getRepository('Teste\Entity\User'));

        $abstractRepository->setQuery($abstractRepository->getRepository()
            ->createQueryBuilder($abstractRepository->getAliase()));

        $abstractRepository->setFilter(array(
            'preco' => 'meuvalorasertestado'
        ));

        $abstractRepository->setUpJoin();
    }

    public function testGerOrderedByMapNoexisting()
    {
        $abstractRepository = $this->getMockAbstractClass('Teste\Repository\AbstractRepository', array(
            'getMapReferences',
        ));

        $abstractRepository->setEntityManager($this->bootstrap->getEntityManager());
        $abstractRepository->expects($this->any())
            ->method('getMapReferences')
            ->willReturn(
                array(
                    'preco' => array(
                        'type' => 'money'
                    )
                )
            );

        $this->setExpectedException('Exception');

        $abstractRepository->getOrderByMap('exception');
    }
}
