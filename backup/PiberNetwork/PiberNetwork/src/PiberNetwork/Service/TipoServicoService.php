<?php
namespace PiberNetwork\Service;

use PiberNetwork\Service\AbstractService;
use PiberNetwork\Repository\TipoServicoRepository;

class TipoServicoService extends AbstractService
{
    /** @var $repository PiberNetwork\Repository\TipoServico */
    protected $repository;


    public function selectById($idToSelect)
    {
        $repository = $this->getTipoServicoRepository();
        return $repository->selectById($idToSelect);
    }

    public function selectAll()
    {
        $repository = $this->getTipoServicoRepository();
        return $repository->selectAll();
    }


    public function create($data)
    {
        $repository = $this->getTipoServicoRepository();
        $tipoServico = $repository->insert($data);
        return $tipoServico;
    }


    public function update($idTable, $data = array())
    {
        $repository = $this->getTipoServicoRepository();
        $tipoServico = $repository->update($idTable, $data);
        return $tipoServico;
    }

    public function delete($idTable)
    {
        $repository = $this->getTipoServicoRepository();
        $tipoServico = $repository->delete($idTable);


        return $tipoServico;
    }



    public function setTipoServicoRepository(TipoServicoRepository $repository)
    {
        $this->repository = $repository;
        return $this;
    }

    public function getTipoServicoRepository()
    {
        if (!isset($this->repository)) {
            $this->repository =
                $this->getServiceLocator()->get('PiberNetwork\Repository\TipoServicoRepository');
        }
        return $this->repository;
    }
}
