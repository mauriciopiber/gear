<?php

namespace TestUntil\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rule
 *
 * @ORM\Table(name="rule", indexes={@ORM\Index(name="IDX_46D8ACCC61FB397F", columns={"id_action"}), @ORM\Index(name="IDX_46D8ACCCDC499668", columns={"id_role"}), @ORM\Index(name="IDX_46D8ACCCE978E64D", columns={"id_controller"}), @ORM\Index(name="created_by", columns={"created_by"}), @ORM\Index(name="updated_by", columns={"updated_by"})})
 * @ORM\Entity
 */
class Rule
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_rule", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRule;

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
     * @var \TestUntil\Entity\Action
     *
     * @ORM\ManyToOne(targetEntity="TestUntil\Entity\Action")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_action", referencedColumnName="id_action")
     * })
     */
    private $idAction;

    /**
     * @var \TestUntil\Entity\Role
     *
     * @ORM\ManyToOne(targetEntity="TestUntil\Entity\Role")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_role", referencedColumnName="id_role")
     * })
     */
    private $idRole;

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
     * @var \TestUntil\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="TestUntil\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="created_by", referencedColumnName="id_user")
     * })
     */
    private $createdBy;



    /**
     * Get idRule
     *
     * @return integer 
     */
    public function getIdRule()
    {
        return $this->idRule;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Rule
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
     * @return Rule
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
     * @return Rule
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
     * Set idAction
     *
     * @param \TestUntil\Entity\Action $idAction
     * @return Rule
     */
    public function setIdAction(\TestUntil\Entity\Action $idAction = null)
    {
        $this->idAction = $idAction;

        return $this;
    }

    /**
     * Get idAction
     *
     * @return \TestUntil\Entity\Action 
     */
    public function getIdAction()
    {
        return $this->idAction;
    }

    /**
     * Set idRole
     *
     * @param \TestUntil\Entity\Role $idRole
     * @return Rule
     */
    public function setIdRole(\TestUntil\Entity\Role $idRole = null)
    {
        $this->idRole = $idRole;

        return $this;
    }

    /**
     * Get idRole
     *
     * @return \TestUntil\Entity\Role 
     */
    public function getIdRole()
    {
        return $this->idRole;
    }

    /**
     * Set idController
     *
     * @param \TestUntil\Entity\Controller $idController
     * @return Rule
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

    /**
     * Set createdBy
     *
     * @param \TestUntil\Entity\User $createdBy
     * @return Rule
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
}
