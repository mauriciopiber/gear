<?php
namespace PiberNetwork\PiberNetworkTest\RepositoryTest;

class CustoTest extends \PHPUnit_Framework_TestCase
{
    protected $custo;

    protected function setUp()
    {
        $this->bootstrap = new \PiberNetwork\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getCusto()
    {
        if (!isset($this->custo)) {
            $this->custo =
                $this->bootstrap->getServiceLocator()->get('PiberNetwork\Repository\CustoRepository');
        }
        return $this->custo;
    }

    /**
     * @group PiberNetwork
     * @group Custo2New
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getCusto()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }


    /**
     * @group PiberNetwork
     * @group Custo2New
     */
    public function testCallUsingServiceLocator()
    {
        $custo = $this->getCusto();
        $this->assertInstanceOf('PiberNetwork\Repository\CustoRepository', $custo);
    }

    /**
     * @group PiberNetwork
     * @group CustoNew
     */
    public function testSelectAllWithDateEnd()
    {
        $custo = $this->getCusto();

        $data =  array('likeField' => 'adss',
            'idStatusCusto' =>  '3',
            'idTipoCusto' =>  '',
            'dataCustoPre' =>  '',
            'dataCustoPos' =>  '01/12/2014',
            'valorPre' =>  '',
            'valorPos' =>  '',
            'submit' =>  'Pesquisar');

        $resultSet = $custo->selectAll($data);

        $this->assertTrue(is_array($resultSet));
    }

    /**
     * @group PiberNetwork
     * @group CustoNew
     */
    public function testSelectAllWithDateBegin()
    {
        $custo = $this->getCusto();

        $data =  array('likeField' => 'asdd',
            'idStatusCusto' =>  '3',
            'idTipoCusto' =>  '',
            'dataCustoPre' =>  '01/11/2014',
            'dataCustoPos' =>  '',
            'valorPre' =>  '',
            'valorPos' =>  '',
            'submit' =>  'Pesquisar');

        $resultSet = $custo->selectAll($data);

        $this->assertTrue(is_array($resultSet));
    }

    /**
     * @group PiberNetwork
     * @group CustoNew
     */
    public function testSelectAllBetweenDates()
    {
        $custo = $this->getCusto();

        $data =  array('likeField' => 'asdd',
            'idStatusCusto' =>  '3',
            'idTipoCusto' =>  '',
            'dataCustoPre' =>  '01/11/2014',
            'dataCustoPos' =>  '01/11/2015',
            'valorPre' =>  '',
            'valorPos' =>  '',
            'submit' =>  'Pesquisar');

        $resultSet = $custo->selectAll($data);

        $this->assertTrue(is_array($resultSet));
    }
}
