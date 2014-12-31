<?php

namespace TestUntil\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Action
 *
 * @ORM\Table(name="action", indexes={@ORM\Index(name="IDX_47CC8C92E978E64D", columns={"id_controller"}), @ORM\Index(name="created_by", columns={"created_by"}), @ORM\Index(name="updated_by", columns={"updated_by"})})
 * @ORM\Entity
 */
class Action
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_action", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAction;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=150, nullable=false)
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
     * @var \TestUntil\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="TestUntil\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="updated_by", referencedColumnName="id_user")
     * })
     */
    private $updatedBy;

    /**
     * @var \TestUntil\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="TestUntil\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="created_by", referencedColumnName="id_user")
     * })
     */
    private $createdBy;

    /**
     * @var \TestUntil\Entity\Controller
     *
     * @ORM\ManyToOne(targetEntity="TestUntil\Entity\Controller")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_controller", referencedColumnName="id_controller")
     * })
     */
    private $idController;



    /**
     * Get idAction
     *
     * @return integer 
     */
    public function getIdAction()
    {
        return $this->idAction;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Action
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
     * @return Action
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
     * @return Action
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
     * Set updatedBy
     *
     * @param \TestUntil\Entity\User $updatedBy
     * @return Action
     */
    public function setUpdatedBy(\TestUntil\Entity\User $updatedBy = null)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return \TestUntil\Entity\User 
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * Set createdBy
     *
     * @param \TestUntil\Entity\User $createdBy
     * @return Action
     */
    public function setCreatedBy(\TestUntil\Entity\User $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \TestUntil\Entity\User 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set idController
     *
     * @param \TestUntil\Entity\Controller $idController
     * @return Action
     */
    public function setIdController(\TestUntil\Entity\Controller $idController = null)
    {
        $this->idController = $idController;

        return $this;
    }

    /**
     * Get idController
     *
     * @return \TestUntil\Entity\Controller 
     */
    public function getIdController()
    {
        return $this->idController;
    }
}
