<?php

namespace PiberNetwork\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Custo
 *
 * @ORM\Table(name="custo", indexes={@ORM\Index(name="fk_custo_2", columns={"id_tipo_custo"}), @ORM\Index(name="fk_custo_1", columns={"id_status_custo"})})
 * @ORM\Entity
 */
class Custo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_custo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCusto;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $valor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_custo", type="datetime", nullable=true)
     */
    private $dataCusto;

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
     * @var \PiberNetwork\Entity\StatusCusto
     *
     * @ORM\ManyToOne(targetEntity="PiberNetwork\Entity\StatusCusto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_status_custo", referencedColumnName="id_status_custo")
     * })
     */
    private $idStatusCusto;

    /**
     * @var \PiberNetwork\Entity\TipoCusto
     *
     * @ORM\ManyToOne(targetEntity="PiberNetwork\Entity\TipoCusto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_custo", referencedColumnName="id_tipo_custo")
     * })
     */
    private $idTipoCusto;



    /**
     * Get idCusto
     *
     * @return integer 
     */
    public function getIdCusto()
    {
        return $this->idCusto;
    }

    /**
     * Set valor
     *
     * @param string $valor
     * @return Custo
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return string 
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set dataCusto
     *
     * @param \DateTime $dataCusto
     * @return Custo
     */
    public function setDataCusto($dataCusto)
    {
        $this->dataCusto = $dataCusto;

        return $this;
    }

    /**
     * Get dataCusto
     *
     * @return \DateTime 
     */
    public function getDataCusto()
    {
        return $this->dataCusto;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Custo
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
     * @return Custo
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
     * Set idStatusCusto
     *
     * @param \PiberNetwork\Entity\StatusCusto $idStatusCusto
     * @return Custo
     */
    public function setIdStatusCusto(\PiberNetwork\Entity\StatusCusto $idStatusCusto = null)
    {
        $this->idStatusCusto = $idStatusCusto;

        return $this;
    }

    /**
     * Get idStatusCusto
     *
     * @return \PiberNetwork\Entity\StatusCusto 
     */
    public function getIdStatusCusto()
    {
        return $this->idStatusCusto;
    }

    /**
     * Set idTipoCusto
     *
     * @param \PiberNetwork\Entity\TipoCusto $idTipoCusto
     * @return Custo
     */
    public function setIdTipoCusto(\PiberNetwork\Entity\TipoCusto $idTipoCusto = null)
    {
        $this->idTipoCusto = $idTipoCusto;

        return $this;
    }

    /**
     * Get idTipoCusto
     *
     * @return \PiberNetwork\Entity\TipoCusto 
     */
    public function getIdTipoCusto()
    {
        return $this->idTipoCusto;
    }
}
