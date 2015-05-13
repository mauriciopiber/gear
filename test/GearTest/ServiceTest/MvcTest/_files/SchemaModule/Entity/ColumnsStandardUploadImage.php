<?php

namespace SchemaModule\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ColumnsStandardUploadImage
 *
 * @ORM\Table(name="columns_standard_upload_image", indexes={@ORM\Index(name="created_by", columns={"created_by"}), @ORM\Index(name="updated_by", columns={"updated_by"})})
 * @ORM\Entity
 */
class ColumnsStandardUploadImage
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_columns_standard_upload_image", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idColumnsStandardUploadImage;

    /**
     * @var string
     *
     * @ORM\Column(name="column_varchar", type="string", length=100, nullable=true)
     */
    private $columnVarchar;

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

