<?php

namespace Column\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ForeignKeys
 *
 * @ORM\Table(
 *     name="foreign_keys",
 *     indexes={
 *         @ORM\Index(name="created_by", columns={"created_by"}),
 *         @ORM\Index(name="updated_by", columns={"updated_by"})
 *     }
 * )
 * @ORM\Entity
 */
class ForeignKeys
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_foreign_keys", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idForeignKeys;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     */
    private $name;

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
     * @var \Security\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Security\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="created_by", referencedColumnName="id_user")
     * })
     */
    private $createdBy;

    /**
     * @var \Security\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Security\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="updated_by", referencedColumnName="id_user")
     * })
     */
    private $updatedBy;



    /**
     * Get idForeignKeys
     *
     * @return integer
     */
    public function getIdForeignKeys()
    {
        return $this->idForeignKeys;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return ForeignKeys
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return ForeignKeys
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
     *
     * @return ForeignKeys
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
     * @param \Security\Entity\User $createdBy
     *
     * @return ForeignKeys
     */
    public function setCreatedBy(\Security\Entity\User $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \Security\Entity\User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set updatedBy
     *
     * @param \Security\Entity\User $updatedBy
     *
     * @return ForeignKeys
     */
    public function setUpdatedBy(\Security\Entity\User $updatedBy = null)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return \Security\Entity\User
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }
}
