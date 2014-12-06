<?php

namespace PiberNetwork\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PrecoTipoServico
 *
 * @ORM\Table(name="preco_tipo_servico", indexes={@ORM\Index(name="fk_preco_tipo_servico_1", columns={"id_tipo_servico"})})
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
     * @var \PiberNetwork\Entity\TipoServico
     *
     * @ORM\ManyToOne(targetEntity="PiberNetwork\Entity\TipoServico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_servico", referencedColumnName="id_tipo_servico")
     * })
     */
    private $idTipoServico;



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
     * Set idTipoServico
     *
     * @param \PiberNetwork\Entity\TipoServico $idTipoServico
     * @return PrecoTipoServico
     */
    public function setIdTipoServico(\PiberNetwork\Entity\TipoServico $idTipoServico = null)
    {
        $this->idTipoServico = $idTipoServico;

        return $this;
    }

    /**
     * Get idTipoServico
     *
     * @return \PiberNetwork\Entity\TipoServico 
     */
    public function getIdTipoServico()
    {
        return $this->idTipoServico;
    }
}
