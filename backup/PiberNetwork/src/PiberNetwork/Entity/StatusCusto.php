<?php

namespace PiberNetwork\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StatusCusto
 *
 * @ORM\Table(name="status_custo")
 * @ORM\Entity
 */
class StatusCusto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_status_custo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idStatusCusto;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=100, nullable=true)
     */
    private $nome;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;



    /**
     * Get idStatusCusto
     *
     * @return integer 
     */
    public function getIdStatusCusto()
    {
        return $this->idStatusCusto;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return StatusCusto
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return StatusCusto
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
     * @return StatusCusto
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
}
