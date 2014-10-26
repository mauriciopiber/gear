<?php

namespace Gear\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Email
 *
 * @ORM\Table(name="email")
 * @ORM\Entity
 */
class Email
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_email", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="remetente", type="string", length=150, nullable=true)
     */
    private $remetente;

    /**
     * @var string
     *
     * @ORM\Column(name="destino", type="string", length=150, nullable=false)
     */
    private $destino;

    /**
     * @var string
     *
     * @ORM\Column(name="assunto", type="string", length=100, nullable=false)
     */
    private $assunto;

    /**
     * @var string
     *
     * @ORM\Column(name="mensagem", type="text", nullable=false)
     */
    private $mensagem;

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
     * Get idEmail
     *
     * @return integer 
     */
    public function getIdEmail()
    {
        return $this->idEmail;
    }

    /**
     * Set remetente
     *
     * @param string $remetente
     * @return Email
     */
    public function setRemetente($remetente)
    {
        $this->remetente = $remetente;

        return $this;
    }

    /**
     * Get remetente
     *
     * @return string 
     */
    public function getRemetente()
    {
        return $this->remetente;
    }

    /**
     * Set destino
     *
     * @param string $destino
     * @return Email
     */
    public function setDestino($destino)
    {
        $this->destino = $destino;

        return $this;
    }

    /**
     * Get destino
     *
     * @return string 
     */
    public function getDestino()
    {
        return $this->destino;
    }

    /**
     * Set assunto
     *
     * @param string $assunto
     * @return Email
     */
    public function setAssunto($assunto)
    {
        $this->assunto = $assunto;

        return $this;
    }

    /**
     * Get assunto
     *
     * @return string 
     */
    public function getAssunto()
    {
        return $this->assunto;
    }

    /**
     * Set mensagem
     *
     * @param string $mensagem
     * @return Email
     */
    public function setMensagem($mensagem)
    {
        $this->mensagem = $mensagem;

        return $this;
    }

    /**
     * Get mensagem
     *
     * @return string 
     */
    public function getMensagem()
    {
        return $this->mensagem;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Email
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
     * @return Email
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
