<?php

namespace Gear\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rule
 *
 * @ORM\Table(name="rule", indexes={@ORM\Index(name="IDX_46D8ACCC61FB397F", columns={"id_action"}), @ORM\Index(name="IDX_46D8ACCCDC499668", columns={"id_role"}), @ORM\Index(name="IDX_46D8ACCCE978E64D", columns={"id_controller"})})
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
     * @var \Gear\Entity\Controller
     *
     * @ORM\ManyToOne(targetEntity="Gear\Entity\Controller")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_controller", referencedColumnName="id_controller")
     * })
     */
    private $idController;

    /**
     * @var \Gear\Entity\Action
     *
     * @ORM\ManyToOne(targetEntity="Gear\Entity\Action")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_action", referencedColumnName="id_action")
     * })
     */
    private $idAction;

    /**
     * @var \Gear\Entity\Role
     *
     * @ORM\ManyToOne(targetEntity="Gear\Entity\Role")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_role", referencedColumnName="id_role")
     * })
     */
    private $idRole;



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
     * Set idController
     *
     * @param \Gear\Entity\Controller $idController
     * @return Rule
     */
    public function setIdController(\Gear\Entity\Controller $idController = null)
    {
        $this->idController = $idController;

        return $this;
    }

    /**
     * Get idController
     *
     * @return \Gear\Entity\Controller 
     */
    public function getIdController()
    {
        return $this->idController;
    }

    /**
     * Set idAction
     *
     * @param \Gear\Entity\Action $idAction
     * @return Rule
     */
    public function setIdAction(\Gear\Entity\Action $idAction = null)
    {
        $this->idAction = $idAction;

        return $this;
    }

    /**
     * Get idAction
     *
     * @return \Gear\Entity\Action 
     */
    public function getIdAction()
    {
        return $this->idAction;
    }

    /**
     * Set idRole
     *
     * @param \Gear\Entity\Role $idRole
     * @return Rule
     */
    public function setIdRole(\Gear\Entity\Role $idRole = null)
    {
        $this->idRole = $idRole;

        return $this;
    }

    /**
     * Get idRole
     *
     * @return \Gear\Entity\Role 
     */
    public function getIdRole()
    {
        return $this->idRole;
    }
}
