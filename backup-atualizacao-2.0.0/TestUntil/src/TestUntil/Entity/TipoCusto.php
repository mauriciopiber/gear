<?php

namespace TestUntil\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoCusto
 *
 * @ORM\Table(name="tipo_custo", indexes={@ORM\Index(name="fk_tipo_custo_1", columns={"id_grupo_custo"}), @ORM\Index(name="updated_by", columns={"updated_by"})})
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
     * @var integer
     *
     * @ORM\Column(name="created_by", type="integer", nullable=false)
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
     * @var \TestUntil\Entity\GrupoCusto
     *
     * @ORM\ManyToOne(targetEntity="TestUntil\Entity\GrupoCusto")
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
     * Set createdBy
     *
     * @param integer $createdBy
     * @return TipoCusto
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return integer 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set updatedBy
     *
     * @param \TestUntil\Entity\User $updatedBy
     * @return TipoCusto
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
     * Set idGrupoCusto
     *
     * @param \TestUntil\Entity\GrupoCusto $idGrupoCusto
     * @return TipoCusto
     */
    public function setIdGrupoCusto(\TestUntil\Entity\GrupoCusto $idGrupoCusto = null)
    {
        $this->idGrupoCusto = $idGrupoCusto;

        return $this;
    }

    /**
     * Get idGrupoCusto
     *
     * @return \TestUntil\Entity\GrupoCusto 
     */
    public function getIdGrupoCusto()
    {
        return $this->idGrupoCusto;
    }
}
