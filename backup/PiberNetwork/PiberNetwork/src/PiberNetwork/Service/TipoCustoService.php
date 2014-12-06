<?php
namespace PiberNetwork\Service;

use PiberNetwork\Service\AbstractService;
use PiberNetwork\Repository\TipoCustoRepository;
use Zend\Session\Container;

class TipoCustoService extends AbstractService
{
    /** @var $tipoCustoRepository PiberNetwork\Repository\TipoCusto */
    protected $tipoCustoRepository;

    public function getTableHead()
    {
        return array(
            array('name' => 'idTipoCusto', 'label' => 'Tipo Custo'),
            array('name' => 'idGrupoCusto', 'label' => 'Grupo Custo'),
            array('name' => 'nome', 'label' => 'Nome')
        );
    }

    public function getData($prg)
    {
        $orderBy = $this->getRouteMatch()->getParam('orderBy');

        $sessionData = new Container('tipoCustoSession');
        if ($orderBy == null) {
            unset($sessionData->prg);
        }
        if ($prg == false) {
            $data = $this->selectAll($sessionData->prg);
        } else {
            $sessionData->prg = $prg;
            $data = $this->selectAll($prg);
        }
        return $this->getPaginator($data);
    }

    public function selectById($idToSelect)
    {
        $repository = $this->getTipoCustoRepository();
        return $repository->selectById($idToSelect);
    }

    public function selectAll($select = array())
    {
        $repository = $this->getTipoCustoRepository();
        return $repository->selectAll($select, $this->getOrderBy(), $this->getOrder());
    }

    public function create($data)
    {
        $repository = $this->getTipoCustoRepository();
        $tipoCusto = $repository->insert($data);
        return $tipoCusto;
    }

    public function update($idTable, $data = array())
    {
        $repository = $this->getTipoCustoRepository();
        $tipoCusto = $repository->update($idTable, $data);
        return $tipoCusto;
    }

    public function delete($idTable)
    {
        $repository = $this->getTipoCustoRepository();
        $tipoCusto = $repository->delete($idTable);
        return $tipoCusto;
    }

    public function setTipoCustoRepository(TipoCustoRepository $tipoCustoRepository)
    {
        $this->tipoCustoRepository = $tipoCustoRepository;
        return $this;
    }

    public function getTipoCustoRepository()
    {
        if (!isset($this->tipoCustoRepository)) {
            $this->tipoCustoRepository =
                $this->getServiceLocator()->get('PiberNetwork\Repository\TipoCustoRepository');
        }
        return $this->tipoCustoRepository;
    }
}
