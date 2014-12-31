<?php

namespace TestUntil\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Custo
 *
 * @ORM\Table(name="custo", indexes={@ORM\Index(name="fk_custo_2", columns={"id_tipo_custo"}), @ORM\Index(name="fk_custo_1", columns={"id_status_custo"}), @ORM\Index(name="created_by", columns={"created_by"}), @ORM\Index(name="updated_by", columns={"updated_by"})})
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
     * @ORM\Column(name="data_custo", type="date", nullable=true)
     */
    private $dataCusto;

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
     *   @ORM\JoinColumn(name="created_by", referencedColumnName="id_user")
     * })
     */
    private $createdBy;

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
     * @var \TestUntil\Entity\StatusCusto
     *
     * @ORM\ManyToOne(targetEntity="TestUntil\Entity\StatusCusto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_status_custo", referencedColumnName="id_status_custo")
     * })
     */
    private $idStatusCusto;

    /**
     * @var \TestUntil\Entity\TipoCusto
     *
     * @ORM\ManyToOne(targetEntity="TestUntil\Entity\TipoCusto")
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
     * Set createdBy
     *
     * @param \TestUntil\Entity\User $createdBy
     * @return Custo
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
     * Set updatedBy
     *
     * @param \TestUntil\Entity\User $updatedBy
     * @return Custo
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
     * Set idStatusCusto
     *
     * @param \TestUntil\Entity\StatusCusto $idStatusCusto
     * @return Custo
     */
    public function setIdStatusCusto(\TestUntil\Entity\StatusCusto $idStatusCusto = null)
    {
        $this->idStatusCusto = $idStatusCusto;

        return $this;
    }

    /**
     * Get idStatusCusto
     *
     * @return \TestUntil\Entity\StatusCusto 
     */
    public function getIdStatusCusto()
    {
        return $this->idStatusCusto;
    }

    /**
     * Set idTipoCusto
     *
     * @param \TestUntil\Entity\TipoCusto $idTipoCusto
     * @return Custo
     */
    public function setIdTipoCusto(\TestUntil\Entity\TipoCusto $idTipoCusto = null)
    {
        $this->idTipoCusto = $idTipoCusto;

        return $this;
    }

    /**
     * Get idTipoCusto
     *
     * @return \TestUntil\Entity\TipoCusto 
     */
    public function getIdTipoCusto()
    {
        return $this->idTipoCusto;
    }
}
