<?php

namespace PiberNetwork\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoCusto
 *
 * @ORM\Table(name="tipo_custo", indexes={@ORM\Index(name="fk_tipo_custo_1", columns={"id_gropo_custo"})})
 * @ORM\Entity
 */
class TipoCusto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_tipo_custo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTipoCusto;

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
     * @var \PiberNetwork\Entity\GrupoCusto
     *
     * @ORM\ManyToOne(targetEntity="PiberNetwork\Entity\GrupoCusto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_grupo_custo", referencedColumnName="id_grupo_custo")
     * })
     */
    private $idGrupoCusto;



    /**
     * Get idTipoCusto
     *
     * @return integer
     */
    public function getIdTipoCusto()
    {
        return $this->idTipoCusto;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return TipoCusto
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
     * @return TipoCusto
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
     * @return TipoCusto
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
     * Set idGropoCusto
     *
     * @param \PiberNetwork\Entity\GrupoCusto $idGrupoCusto
     * @return TipoCusto
     */
    public function setIdGrupoCusto(\PiberNetwork\Entity\GrupoCusto $idGropoCusto = null)
    {
        $this->idGrupoCusto = $idGropoCusto;

        return $this;
    }

    /**
     * Get idGropoCusto
     *
     * @return \PiberNetwork\Entity\GrupoCusto
     */
    public function getIdGrupoCusto()
    {
        return $this->idGrupoCusto;
    }
}
