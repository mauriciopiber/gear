<?php
namespace TestUpload\Repository;

use TestUpload\Repository\AbstractRepository;

class TestUploadImageRepository extends AbstractRepository
{
    public function getMapReferences()
    {
        return array(
            'idTestUploadImage' => array(
                'label' => 'Test Upload Image',
                'ref' => 'tui.idTestUploadImage',
                'type' => 'primary',
                'aliase' => 'tui',
                'table' => true
            ),
            'image' => array(
                'label' => 'Image',
                'ref' => 'tui.image',
                'type' => 'text',
                'aliase' => 'tui',
                'table' => false
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
        return 'TestUpload\Entity\TestUploadImage';
    }

    public function getAliase()
    {
        return 'tui';
    }

    public function selectById($idTestUploadImage)
    {
        return $this->getRepository()->findOneBy(
            array('idTestUploadImage' => $idTestUploadImage)
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
        $entity = new \TestUpload\Entity\TestUploadImage();
        $entity->setCreated(new \DateTime('now'));
        $entity->setCreatedBy($this->getUser());
        $this->hydrate($data, $entity);
        $this->getEventManager()->trigger(__FUNCTION__.'.pre', $this, $entity);
        $this->persist($entity);
        $this->getEventManager()->trigger(__FUNCTION__.'.post', $this, $entity);
        return $entity;
    }
}
