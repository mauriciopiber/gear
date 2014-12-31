<?php

namespace TestUntil\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClientePessoaJuridica
 *
 * @ORM\Table(name="cliente_pessoa_juridica", indexes={@ORM\Index(name="fk_cliente_pessoa_juridica_1", columns={"id_cliente"}), @ORM\Index(name="created_by", columns={"created_by"}), @ORM\Index(name="updated_by", columns={"updated_by"})})
 * @ORM\Entity
 */
class ClientePessoaJuridica
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_cliente_pessoa_juridica", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idClientePessoaJuridica;

    /**
     * @var string
     *
     * @ORM\Column(name="razao_social", type="string", length=100, nullable=true)
     */
    private $razaoSocial;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_fantasia", type="string", length=100, nullable=true)
     */
    private $nomeFantasia;

    /**
     * @var string
     *
     * @ORM\Column(name="cnpj", type="string", length=100, nullable=true)
     */
    private $cnpj;

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
     *   @ORM\JoinColumn(name="updated_by", referencedColumnName="id_user")
     * })
     */
    private $updatedBy;

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
     * @var \TestUntil\Entity\Cliente
     *
     * @ORM\ManyToOne(targetEntity="TestUntil\Entity\Cliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cliente", referencedColumnName="id_cliente")
     * })
     */
    private $idCliente;



    /**
     * Get idClientePessoaJuridica
     *
     * @return integer 
     */
    public function getIdClientePessoaJuridica()
    {
        return $this->idClientePessoaJuridica;
    }

    /**
     * Set razaoSocial
     *
     * @param string $razaoSocial
     * @return ClientePessoaJuridica
     */
    public function setRazaoSocial($razaoSocial)
    {
        $this->razaoSocial = $razaoSocial;

        return $this;
    }

    /**
     * Get razaoSocial
     *
     * @return string 
     */
    public function getRazaoSocial()
    {
        return $this->razaoSocial;
    }

    /**
     * Set nomeFantasia
     *
     * @param string $nomeFantasia
     * @return ClientePessoaJuridica
     */
    public function setNomeFantasia($nomeFantasia)
    {
        $this->nomeFantasia = $nomeFantasia;

        return $this;
    }

    /**
     * Get nomeFantasia
     *
     * @return string 
     */
    public function getNomeFantasia()
    {
        return $this->nomeFantasia;
    }

    /**
     * Set cnpj
     *
     * @param string $cnpj
     * @return ClientePessoaJuridica
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;

        return $this;
    }

    /**
     * Get cnpj
     *
     * @return string 
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return ClientePessoaJuridica
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
     * @return ClientePessoaJuridica
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
     * Set updatedBy
     *
     * @param \TestUntil\Entity\User $updatedBy
     * @return ClientePessoaJuridica
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
     * Set createdBy
     *
     * @param \TestUntil\Entity\User $createdBy
     * @return ClientePessoaJuridica
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
     * Set idCliente
     *
     * @param \TestUntil\Entity\Cliente $idCliente
     * @return ClientePessoaJuridica
     */
    public function setIdCliente(\TestUntil\Entity\Cliente $idCliente = null)
    {
        $this->idCliente = $idCliente;

        return $this;
    }

    /**
     * Get idCliente
     *
     * @return \TestUntil\Entity\Cliente 
     */
    public function getIdCliente()
    {
        return $this->idCliente;
    }
}
