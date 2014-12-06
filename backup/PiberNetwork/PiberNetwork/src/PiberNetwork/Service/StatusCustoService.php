<?php
namespace PiberNetwork\Service;

use PiberNetwork\Service\AbstractService;
use PiberNetwork\Repository\StatusCustoRepository;

class StatusCustoService extends AbstractService
{
    /** @var $repository PiberNetwork\Repository\StatusCusto */
    protected $repository;


    public function selectById($idToSelect)
    {
        $repository = $this->getStatusCustoRepository();
        return $repository->selectById($idToSelect);
    }

    public function selectAll()
    {
        $repository = $this->getStatusCustoRepository();
        return $repository->selectAll();
    }


    public function create($data)
    {
        $repository = $this->getStatusCustoRepository();
        $statusCusto = $repository->insert($data);
        return $statusCusto;
    }


    public function update($idTable, $data = array())
    {
        $repository = $this->getStatusCustoRepository();
        $statusCusto = $repository->update($idTable, $data);
        return $statusCusto;
    }

    public function delete($idTable)
    {
        $repository = $this->getStatusCustoRepository();
        $statusCusto = $repository->delete($idTable);


        return $statusCusto;
    }



    public function setStatusCustoRepository(StatusCustoRepository $repository)
    {
        $this->repository = $repository;
        return $this;
    }

    public function getStatusCustoRepository()
    {
        if (!isset($this->repository)) {
            $this->repository =
                $this->getServiceLocator()->get('PiberNetwork\Repository\StatusCustoRepository');
        }
        return $this->repository;
    }
}
