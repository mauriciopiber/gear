<?php

namespace TestUpload\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TestUploadImage
 *
 * @ORM\Table(
 *     name="test_upload_image",
 *     indexes={
 *         @ORM\Index(name="created_by", columns={"created_by"}),
 *         @ORM\Index(name="updated_by", columns={"updated_by"})
 *     }
 * )
 * @ORM\Entity
 */
class TestUploadImage
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_test_upload_image", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTestUploadImage;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

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
     * Get idTestUploadImage
     *
     * @return integer
     */
    public function getIdTestUploadImage()
    {
        return $this->idTestUploadImage;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return TestUploadImage
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return TestUploadImage
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
     * @return TestUploadImage
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
     * @return TestUploadImage
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
     * @return TestUploadImage
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
