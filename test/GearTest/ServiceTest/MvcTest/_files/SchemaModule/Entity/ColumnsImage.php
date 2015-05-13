<?php

namespace SchemaModule\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ColumnsImage
 *
 * @ORM\Table(name="columns_image", indexes={@ORM\Index(name="fk_columns_image_1", columns={"created_by"}), @ORM\Index(name="fk_columns_image_2", columns={"updated_by"})})
 * @ORM\Entity
 */
class ColumnsImage
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_columns_image", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idColumnsImage;

    /**
     * @var string
     *
     * @ORM\Column(name="upload_image_one", type="string", length=255, nullable=true)
     */
    private $uploadImageOne;

    /**
     * @var string
     *
     * @ORM\Column(name="upload_image_two", type="string", length=255, nullable=true)
     */
    private $uploadImageTwo;

    /**
     * @var string
     *
     * @ORM\Column(name="upload_image_three", type="string", length=255, nullable=true)
     */
    private $uploadImageThree;

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

