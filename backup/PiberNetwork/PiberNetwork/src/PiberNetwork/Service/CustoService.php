<?php
namespace PiberNetwork\Service;

use PiberNetwork\Service\AbstractService;
use PiberNetwork\Repository\CustoRepository;
use Zend\Session\Container;

class CustoService extends AbstractService
{
    /** @var $custoRepository PiberNetwork\Repository\Custo */
    protected $custoRepository;

    public function getTableHead()
    {
        return array(
            array('name' => 'idCusto', 'label' => 'Id Custo'),
            array('name' => 'idStatusCusto', 'label' => 'Status Custo'),
            array('name' => 'idTipoCusto', 'label' => 'Tipo Custo'),
            array('name' => 'valor', 'label' => 'Valor'),
            array('name' => 'dataCusto', 'label' => 'Data Custo')
        );
    }

    public function getSessionName()
    {
        return 'custoSession';
    }

    public function selectById($idToSelect)
    {
        $repository = $this->getCustoRepository();
        return $repository->selectById($idToSelect);
    }

    public function selectAll($data)
    {
        $repository = $this->getCustoRepository();
        return $repository->selectAll($data, $this->getOrderBy(), $this->getOrder());
    }


    public function create($data)
    {
        $repository = $this->getCustoRepository();
        $custo = $repository->insert($data);
        return $custo;
    }

    public function update($idTable, $data = array())
    {
        $repository = $this->getCustoRepository();
        $custo = $repository->update($idTable, $data);
        return $custo;
    }

    public function delete($idTable)
    {
        $repository = $this->getCustoRepository();
        $custo = $repository->delete($idTable);
        return $custo;
    }

    public function setCustoRepository(CustoRepository $custoRepository)
    {
        $this->custoRepository = $custoRepository;
        return $this;
    }

    public function getCustoRepository()
    {
        if (!isset($this->custoRepository)) {
            $this->custoRepository =
                $this->getServiceLocator()->get('PiberNetwork\Repository\CustoRepository');
        }
        return $this->custoRepository;
    }
}
