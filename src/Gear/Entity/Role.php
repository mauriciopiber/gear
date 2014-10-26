<?php

namespace Gear\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @ORM\Table(name="role", indexes={@ORM\Index(name="IDX_57698A6A1BB9D5A2", columns={"id_parent"})})
 * @ORM\Entity
 */
class Role
{
    /**
     * @var string
     *
     * @ORM\Column(name="id_role", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRole;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @var \Gear\Entity\Role
     *
     * @ORM\ManyToOne(targetEntity="Gear\Entity\Role")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parent", referencedColumnName="id_role")
     * })
     */
    private $idParent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Gear\Entity\User", mappedBy="idRole")
     */
    private $idUser;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idUser = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get idRole
     *
     * @return string 
     */
    public function getIdRole()
    {
        return $this->idRole;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Role
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Role
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Role
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set idParent
     *
     * @param \Gear\Entity\Role $idParent
     * @return Role
     */
    public function setIdParent(\Gear\Entity\Role $idParent = null)
    {
        $this->idParent = $idParent;

        return $this;
    }

    /**
     * Get idParent
     *
     * @return \Gear\Entity\Role 
     */
    public function getIdParent()
    {
        return $this->idParent;
    }

    /**
     * Add idUser
     *
     * @param \Gear\Entity\User $idUser
     * @return Role
     */
    public function addIdUser(\Gear\Entity\User $idUser)
    {
        $this->idUser[***REMOVED*** = $idUser;

        return $this;
    }

    /**
     * Remove idUser
     *
     * @param \Gear\Entity\User $idUser
     */
    public function removeIdUser(\Gear\Entity\User $idUser)
    {
        $this->idUser->removeElement($idUser);
    }

    /**
     * Get idUser
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdUser()
    {
        return $this->idUser;
    }
}
