<?php

namespace TestUntil\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PrecoTipoServico
 *
 * @ORM\Table(name="preco_tipo_servico", indexes={@ORM\Index(name="fk_preco_tipo_servico_1", columns={"id_tipo_servico"}), @ORM\Index(name="created_by", columns={"created_by"}), @ORM\Index(name="updated_by", columns={"updated_by"})})
 * @ORM\Entity
 */
class PrecoTipoServico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_preco_tipo_servico", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPrecoTipoServico;

    /**
     * @var string
     *
     * @ORM\Column(name="preco_hora", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $precoHora;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_inicio", type="datetime", nullable=false)
     */
    private $dataInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_final", type="datetime", nullable=false)
     */
    private $dataFinal;

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
     * @var string
     *
     * @ORM\Column(name="descricao_do_servico", type="text", length=65535, nullable=true)
     */
    private $descricaoDoServico;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_especial", type="date", nullable=true)
     */
    private $dataEspecial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_compromisso", type="datetime", nullable=true)
     */
    private $dataCompromisso;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_promocao", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $valorPromocao;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_responsavel", type="string", length=100, nullable=true)
     */
    private $nomeResponsavel;

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
     * @var \TestUntil\Entity\TipoServico
     *
     * @ORM\ManyToOne(targetEntity="TestUntil\Entity\TipoServico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_servico", referencedColumnName="id_tipo_servico")
     * })
     */
    private $idTipoServico;

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
     * Get idPrecoTipoServico
     *
     * @return integer 
     */
    public function getIdPrecoTipoServico()
    {
        return $this->idPrecoTipoServico;
    }

    /**
     * Set precoHora
     *
     * @param string $precoHora
     * @return PrecoTipoServico
     */
    public function setPrecoHora($precoHora)
    {
        $this->precoHora = $precoHora;

        return $this;
    }

    /**
     * Get precoHora
     *
     * @return string 
     */
    public function getPrecoHora()
    {
        return $this->precoHora;
    }

    /**
     * Set dataInicio
     *
     * @param \DateTime $dataInicio
     * @return PrecoTipoServico
     */
    public function setDataInicio($dataInicio)
    {
        $this->dataInicio = $dataInicio;

        return $this;
    }

    /**
     * Get dataInicio
     *
     * @return \DateTime 
     */
    public function getDataInicio()
    {
        return $this->dataInicio;
    }

    /**
     * Set dataFinal
     *
     * @param \DateTime $dataFinal
     * @return PrecoTipoServico
     */
    public function setDataFinal($dataFinal)
    {
        $this->dataFinal = $dataFinal;

        return $this;
    }

    /**
     * Get dataFinal
     *
     * @return \DateTime 
     */
    public function getDataFinal()
    {
        return $this->dataFinal;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return PrecoTipoServico
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
     * @return PrecoTipoServico
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
     * Set descricaoDoServico
     *
     * @param string $descricaoDoServico
     * @return PrecoTipoServico
     */
    public function setDescricaoDoServico($descricaoDoServico)
    {
        $this->descricaoDoServico = $descricaoDoServico;

        return $this;
    }

    /**
     * Get descricaoDoServico
     *
     * @return string 
     */
    public function getDescricaoDoServico()
    {
        return $this->descricaoDoServico;
    }

    /**
     * Set dataEspecial
     *
     * @param \DateTime $dataEspecial
     * @return PrecoTipoServico
     */
    public function setDataEspecial($dataEspecial)
    {
        $this->dataEspecial = $dataEspecial;

        return $this;
    }

    /**
     * Get dataEspecial
     *
     * @return \DateTime 
     */
    public function getDataEspecial()
    {
        return $this->dataEspecial;
    }

    /**
     * Set dataCompromisso
     *
     * @param \DateTime $dataCompromisso
     * @return PrecoTipoServico
     */
    public function setDataCompromisso($dataCompromisso)
    {
        $this->dataCompromisso = $dataCompromisso;

        return $this;
    }

    /**
     * Get dataCompromisso
     *
     * @return \DateTime 
     */
    public function getDataCompromisso()
    {
        return $this->dataCompromisso;
    }

    /**
     * Set valorPromocao
     *
     * @param string $valorPromocao
     * @return PrecoTipoServico
     */
    public function setValorPromocao($valorPromocao)
    {
        $this->valorPromocao = $valorPromocao;

        return $this;
    }

    /**
     * Get valorPromocao
     *
     * @return string 
     */
    public function getValorPromocao()
    {
        return $this->valorPromocao;
    }

    /**
     * Set nomeResponsavel
     *
     * @param string $nomeResponsavel
     * @return PrecoTipoServico
     */
    public function setNomeResponsavel($nomeResponsavel)
    {
        $this->nomeResponsavel = $nomeResponsavel;

        return $this;
    }

    /**
     * Get nomeResponsavel
     *
     * @return string 
     */
    public function getNomeResponsavel()
    {
        return $this->nomeResponsavel;
    }

    /**
     * Set updatedBy
     *
     * @param \TestUntil\Entity\User $updatedBy
     * @return PrecoTipoServico
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
     * Set idTipoServico
     *
     * @param \TestUntil\Entity\TipoServico $idTipoServico
     * @return PrecoTipoServico
     */
    public function setIdTipoServico(\TestUntil\Entity\TipoServico $idTipoServico = null)
    {
        $this->idTipoServico = $idTipoServico;

        return $this;
    }

    /**
     * Get idTipoServico
     *
     * @return \TestUntil\Entity\TipoServico 
     */
    public function getIdTipoServico()
    {
        return $this->idTipoServico;
    }

    /**
     * Set createdBy
     *
     * @param \TestUntil\Entity\User $createdBy
     * @return PrecoTipoServico
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
