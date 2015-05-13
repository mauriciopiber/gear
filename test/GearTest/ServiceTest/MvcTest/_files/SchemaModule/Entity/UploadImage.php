<?php

namespace SchemaModule\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UploadImage
 *
 * @ORM\Table(name="upload_image", uniqueConstraints={@ORM\UniqueConstraint(name="upload_image", columns={"upload_image"})}, indexes={@ORM\Index(name="created_by", columns={"created_by"}), @ORM\Index(name="updated_by", columns={"updated_by"}), @ORM\Index(name="fk_upload_image_1", columns={"id_columns_image"}), @ORM\Index(name="fk_upload_image_2", columns={"id_columns_standard_upload_image"})})
 * @ORM\Entity
 */
class UploadImage
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_upload_image", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUploadImage;

    /**
     * @var string
     *
     * @ORM\Column(name="upload_image", type="string", length=255, nullable=false)
     */
    private $uploadImage;

    /**
     * @var integer
     *
     * @ORM\Column(name="ordination", type="integer", nullable=false)
     */
    private $ordination;

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
     * @var \SchemaModule\Entity\ColumnsImage
     *
     * @ORM\ManyToOne(targetEntity="SchemaModule\Entity\ColumnsImage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_columns_image", referencedColumnName="id_columns_image")
     * })
     */
    private $idColumnsImage;

    /**
     * @var \SchemaModule\Entity\ColumnsStandardUploadImage
     *
     * @ORM\ManyToOne(targetEntity="SchemaModule\Entity\ColumnsStandardUploadImage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_columns_standard_upload_image", referencedColumnName="id_columns_standard_upload_image")
     * })
     */
    private $idColumnsStandardUploadImage;

    /**
     * @var \SchemaModule\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="SchemaModule\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="created_by", referencedColumnName="id_user")
     * })
     */
    private $createdBy;

    /**
     * @var \SchemaModule\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="SchemaModule\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="updated_by", referencedColumnName="id_user")
     * })
     */
    private $updatedBy;


}

