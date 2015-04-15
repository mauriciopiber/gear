<?php
namespace Teste\Repository;

use Teste\Repository\AbstractRepository;

class EmailRepository extends AbstractRepository
{
    public function getMapReferences()
    {
        return array(
            'idEmail' => array(
                'label' => 'Email',
                'ref' => 'e.idEmail',
                'type' => 'primary',
                'aliase' => 'e',
                'table' => true
            ),
            'remetente' => array(
                'label' => 'Remetente',
                'ref' => 'e.remetente',
                'type' => 'text',
                'aliase' => 'e',
                'table' => true
            ),
            'destino' => array(
                'label' => 'Destino',
                'ref' => 'e.destino',
                'type' => 'text',
                'aliase' => 'e',
                'table' => true
            ),
            'assunto' => array(
                'label' => 'Assunto',
                'ref' => 'e.assunto',
                'type' => 'text',
                'aliase' => 'e',
                'table' => true
            ),
            'mensagem' => array(
                'label' => 'Mensagem',
                'ref' => 'e.mensagem',
                'type' => 'text',
                'aliase' => 'e',
                'table' => true
            ),
            'createdBy' => array(
                'label' => 'Created By',
                'ref' => 'u.email',
                'type' => 'join',
                'aliase' => 'u',
                'table' => false
            ),
        );
    }

    public function getRepositoryName()
    {
        return 'Teste\Entity\Email';
    }

    public function getAliase()
    {
        return 'e';
    }

    public function selectById($idEmail)
    {
        return $this->getRepository()->findOneBy(
            array('idEmail' => $idEmail)
        );
    }

    public function update($idTable, $data)
    {
        $entity = $this->selectById($idTable);
        $entity->setUpdated(new \DateTime('now'));
        $entity->setUpdatedBy($this->getUser());
        $this->hydrate($data, $entity);
        $this->getEventManager()->trigger(__FUNCTION__.'.pre', $this, $entity);
        $this->persist($entity);
        $this->getEventManager()->trigger(__FUNCTION__.'.post', $this, $entity);
        return $entity;
    }

    public function insert($data)
    {
        $entity = new \Teste\Entity\Email();
        $entity->setCreated(new \DateTime('now'));
        $entity->setCreatedBy($this->getUser());
        $this->hydrate($data, $entity);
        $this->getEventManager()->trigger(__FUNCTION__.'.pre', $this, $entity);
        $this->persist($entity);
        $this->getEventManager()->trigger(__FUNCTION__.'.post', $this, $entity);
        return $entity;
    }
}
