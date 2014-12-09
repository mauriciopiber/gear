<?php

namespace PiberNetwork\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GrupoCusto
 *
 * @ORM\Table(name="grupo_custo")
 * @ORM\Entity
 */
class GrupoCusto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_grupo_custo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idGrupoCusto;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=100, nullable=true)
     */
    private $nome;

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
     * Get idGrupoCusto
     *
     * @return integer 
     */
    public function getIdGrupoCusto()
    {
        return $this->idGrupoCusto;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return GrupoCusto
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
     * @return GrupoCusto
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
     * @return GrupoCusto
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
