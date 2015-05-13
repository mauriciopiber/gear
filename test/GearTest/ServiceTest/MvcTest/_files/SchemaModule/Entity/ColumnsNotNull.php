<?php

namespace SchemaModule\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ColumnsNotNull
 *
 * @ORM\Table(name="columns_not_null", indexes={@ORM\Index(name="columns_not_null_ibfk_1", columns={"created_by"}), @ORM\Index(name="columns_not_null_ibfk_2", columns={"updated_by"}), @ORM\Index(name="fk_columns_not_null_1", columns={"column_foreign_key_copy_not_null"})})
 * @ORM\Entity
 */
class ColumnsNotNull
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_columns_not_null", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idColumnsNotNull;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="column_date_not_null", type="date", nullable=false)
     */
    private $columnDateNotNull;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="column_datetime_not_null", type="datetime", nullable=false)
     */
    private $columnDatetimeNotNull;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="column_time_not_null", type="time", nullable=false)
     */
    private $columnTimeNotNull;

    /**
     * @var integer
     *
     * @ORM\Column(name="column_int_not_null", type="integer", nullable=false)
     */
    private $columnIntNotNull;

    /**
     * @var boolean
     *
     * @ORM\Column(name="column_tinyint_not_null", type="boolean", nullable=false)
     */
    private $columnTinyintNotNull;

    /**
     * @var string
     *
     * @ORM\Column(name="column_decimal_not_null", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $columnDecimalNotNull;

    /**
     * @var string
     *
     * @ORM\Column(name="column_varchar_not_null", type="string", length=100, nullable=false)
     */
    private $columnVarcharNotNull;

    /**
     * @var string
     *
     * @ORM\Column(name="column_longtext_not_null", type="text", nullable=false)
     */
    private $columnLongtextNotNull;

    /**
     * @var string
     *
     * @ORM\Column(name="column_text_not_null", type="text", length=65535, nullable=true)
     */
    private $columnTextNotNull;

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
     * @var \DateTime
     *
     * @ORM\Column(name="column_datetime_pt_br_not_null", type="datetime", nullable=false)
     */
    private $columnDatetimePtBrNotNull;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="column_date_pt_br_not_null", type="date", nullable=false)
     */
    private $columnDatePtBrNotNull;

    /**
     * @var string
     *
     * @ORM\Column(name="column_decimal_pt_br_not_null", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $columnDecimalPtBrNotNull;

    /**
     * @var integer
     *
     * @ORM\Column(name="column_int_checkbox_not_null", type="integer", nullable=false)
     */
    private $columnIntCheckboxNotNull;

    /**
     * @var boolean
     *
     * @ORM\Column(name="column_tinyint_checkbox_not_null", type="boolean", nullable=false)
     */
    private $columnTinyintCheckboxNotNull;

    /**
     * @var string
     *
     * @ORM\Column(name="column_varchar_email_not_null", type="string", length=100, nullable=false)
     */
    private $columnVarcharEmailNotNull;

    /**
     * @var string
     *
     * @ORM\Column(name="column_varchar_password_verify_not_null", type="string", length=100, nullable=false)
     */
    private $columnVarcharPasswordVerifyNotNull;

    /**
     * @var string
     *
     * @ORM\Column(name="column_varchar_unique_id_not_null", type="string", length=100, nullable=false)
     */
    private $columnVarcharUniqueIdNotNull;

    /**
     * @var string
     *
     * @ORM\Column(name="column_varchar_upload_image_not_null", type="string", length=255, nullable=true)
     */
    private $columnVarcharUploadImageNotNull;

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
     * @var \SchemaModule\Entity\ForeignKeysCopy
     *
     * @ORM\ManyToOne(targetEntity="SchemaModule\Entity\ForeignKeysCopy")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="column_foreign_key_copy_not_null", referencedColumnName="id_foreign_keys_copy")
     * })
     */
    private $columnForeignKeyCopyNotNull;


}

