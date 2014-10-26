<?php

namespace Gear\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Controller
 *
 * @ORM\Table(name="controller", indexes={@ORM\Index(name="IDX_4CF2669A2A1393C5", columns={"id_module"})})
 * @ORM\Entity
 */
class Controller
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_controller", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idController;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=150, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="invokable", type="string", length=150, nullable=false)
     */
    private $invokable;

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
     * @var \Gear\Entity\Module
     *
     * @ORM\ManyToOne(targetEntity="Gear\Entity\Module")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_module", referencedColumnName="id_module")
     * })
     */
    private $idModule;



    /**
     * Get idController
     *
     * @return integer 
     */
    public function getIdController()
    {
        return $this->idController;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Controller
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
     * Set invokable
     *
     * @param string $invokable
     * @return Controller
     */
    public function setInvokable($invokable)
    {
        $this->invokable = $invokable;

        return $this;
    }

    /**
     * Get invokable
     *
     * @return string 
     */
    public function getInvokable()
    {
        return $this->invokable;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Controller
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
     * @return Controller
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
     * Set idModule
     *
     * @param \Gear\Entity\Module $idModule
     * @return Controller
     */
    public function setIdModule(\Gear\Entity\Module $idModule = null)
    {
        $this->idModule = $idModule;

        return $this;
    }

    /**
     * Get idModule
     *
     * @return \Gear\Entity\Module 
     */
    public function getIdModule()
    {
        return $this->idModule;
    }
}
