<?php

namespace SchemaModule\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ColumnsStandard
 *
 * @ORM\Table(name="columns_standard", indexes={@ORM\Index(name="created_by", columns={"created_by"}), @ORM\Index(name="updated_by", columns={"updated_by"}), @ORM\Index(name="fk_columns_1", columns={"column_foreign_key"})})
 * @ORM\Entity
 */
class ColumnsStandard
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_columns_standard", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idColumnsStandard;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="column_date", type="date", nullable=true)
     */
    private $columnDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="column_datetime", type="datetime", nullable=true)
     */
    private $columnDatetime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="column_time", type="time", nullable=true)
     */
    private $columnTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="column_int", type="integer", nullable=true)
     */
    private $columnInt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="column_tinyint", type="boolean", nullable=true)
     */
    private $columnTinyint;

    /**
     * @var string
     *
     * @ORM\Column(name="column_decimal", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $columnDecimal;

    /**
     * @var string
     *
     * @ORM\Column(name="column_varchar", type="string", length=100, nullable=true)
     */
    private $columnVarchar;

    /**
     * @var string
     *
     * @ORM\Column(name="column_longtext", type="text", nullable=true)
     */
    private $columnLongtext;

    /**
     * @var string
     *
     * @ORM\Column(name="column_text", type="text", length=65535, nullable=true)
     */
    private $columnText;

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

    /**
     * @var \SchemaModule\Entity\ForeignKeys
     *
     * @ORM\ManyToOne(targetEntity="SchemaModule\Entity\ForeignKeys")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="column_foreign_key", referencedColumnName="id_foreign_keys")
     * })
     */
    private $columnForeignKey;


}

