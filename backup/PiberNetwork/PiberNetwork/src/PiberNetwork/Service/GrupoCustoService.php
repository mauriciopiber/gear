<?php
namespace PiberNetwork\Service;

use PiberNetwork\Service\AbstractService;
use PiberNetwork\Repository\GrupoCustoRepository;

class GrupoCustoService extends AbstractService
{
    /** @var $repository PiberNetwork\Repository\GrupoCusto */
    protected $repository;


    public function selectById($idToSelect)
    {
        $repository = $this->getGrupoCustoRepository();
        return $repository->selectById($idToSelect);
    }

    public function selectAll()
    {
        $repository = $this->getGrupoCustoRepository();
        return $repository->selectAll();
    }


    public function create($data)
    {
        $repository = $this->getGrupoCustoRepository();
        $grupoCusto = $repository->insert($data);
        return $grupoCusto;
    }


    public function update($idTable, $data = array())
    {
        $repository = $this->getGrupoCustoRepository();
        $grupoCusto = $repository->update($idTable, $data);
        return $grupoCusto;
    }

    public function delete($idTable)
    {
        $repository = $this->getGrupoCustoRepository();
        $grupoCusto = $repository->delete($idTable);


        return $grupoCusto;
    }



    public function setGrupoCustoRepository(GrupoCustoRepository $repository)
    {
        $this->repository = $repository;
        return $this;
    }

    public function getGrupoCustoRepository()
    {
        if (!isset($this->repository)) {
            $this->repository =
                $this->getServiceLocator()->get('PiberNetwork\Repository\GrupoCustoRepository');
        }
        return $this->repository;
    }
}
