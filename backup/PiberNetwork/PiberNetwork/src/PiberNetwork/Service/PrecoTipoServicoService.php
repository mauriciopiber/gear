<?php
namespace PiberNetwork\Service;

use PiberNetwork\Service\AbstractService;
use PiberNetwork\Repository\PrecoTipoServicoRepository;

class PrecoTipoServicoService extends AbstractService
{
    /** @var $repository PiberNetwork\Repository\PrecoTipoServico */
    protected $repository;


    public function selectById($idToSelect)
    {
        $repository = $this->getPrecoTipoServicoRepository();
        return $repository->selectById($idToSelect);
    }

    public function selectAll()
    {
        $repository = $this->getPrecoTipoServicoRepository();
        return $repository->selectAll();
    }


    public function create($data)
    {
        $repository = $this->getPrecoTipoServicoRepository();
        $precoTipoServico = $repository->insert($data);
        return $precoTipoServico;
    }


    public function update($idTable, $data = array())
    {
        $repository = $this->getPrecoTipoServicoRepository();
        $precoTipoServico = $repository->update($idTable, $data);
        return $precoTipoServico;
    }

    public function delete($idTable)
    {
        $repository = $this->getPrecoTipoServicoRepository();
        $precoTipoServico = $repository->delete($idTable);


        return $precoTipoServico;
    }



    public function setPrecoTipoServicoRepository(PrecoTipoServicoRepository $repository)
    {
        $this->repository = $repository;
        return $this;
    }

    public function getPrecoTipoServicoRepository()
    {
        if (!isset($this->repository)) {
            $this->repository =
                $this->getServiceLocator()->get('PiberNetwork\Repository\PrecoTipoServicoRepository');
        }
        return $this->repository;
    }
}
