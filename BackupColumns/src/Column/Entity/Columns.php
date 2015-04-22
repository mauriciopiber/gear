<?php

namespace Column\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Columns
 *
 * @ORM\Table(
 *     name="columns",
 *     indexes={
 *         @ORM\Index(name="created_by", columns={"created_by"}),
 *         @ORM\Index(name="updated_by", columns={"updated_by"}),
 *         @ORM\Index(name="fk_columns_1", columns={"column_foreign_key"})
 *     }
 * )
 * @ORM\Entity
 */
class Columns
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_columns", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idColumns;

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
     * @var \DateTime
     *
     * @ORM\Column(name="column_datetime_pt_br", type="datetime", nullable=true)
     */
    private $columnDatetimePtBr;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="column_date_pt_br", type="date", nullable=true)
     */
    private $columnDatePtBr;

    /**
     * @var string
     *
     * @ORM\Column(name="column_decimal_pt_br", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $columnDecimalPtBr;

    /**
     * @var integer
     *
     * @ORM\Column(name="column_int_checkbox", type="integer", nullable=true)
     */
    private $columnIntCheckbox;

    /**
     * @var boolean
     *
     * @ORM\Column(name="column_tinyint_checkbox", type="boolean", nullable=true)
     */
    private $columnTinyintCheckbox;

    /**
     * @var string
     *
     * @ORM\Column(name="column_varchar_email", type="string", length=100, nullable=true)
     */
    private $columnVarcharEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="column_varchar_password_verify", type="string", length=100, nullable=true)
     */
    private $columnVarcharPasswordVerify;

    /**
     * @var string
     *
     * @ORM\Column(name="column_varchar_unique_id", type="string", length=100, nullable=true)
     */
    private $columnVarcharUniqueId;

    /**
     * @var string
     *
     * @ORM\Column(name="column_varchar_upload_image", type="string", length=100, nullable=true)
     */
    private $columnVarcharUploadImage;

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
     * @var \Column\Entity\ForeignKeys
     *
     * @ORM\ManyToOne(targetEntity="Column\Entity\ForeignKeys")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="column_foreign_key", referencedColumnName="id_foreign_keys")
     * })
     */
    private $columnForeignKey;



    /**
     * Get idColumns
     *
     * @return integer
     */
    public function getIdColumns()
    {
        return $this->idColumns;
    }

    /**
     * Set columnDate
     *
     * @param \DateTime $columnDate
     *
     * @return Columns
     */
    public function setColumnDate($columnDate)
    {
        $this->columnDate = $columnDate;

        return $this;
    }

    /**
     * Get columnDate
     *
     * @return \DateTime
     */
    public function getColumnDate()
    {
        return $this->columnDate;
    }

    /**
     * Set columnDatetime
     *
     * @param \DateTime $columnDatetime
     *
     * @return Columns
     */
    public function setColumnDatetime($columnDatetime)
    {
        $this->columnDatetime = $columnDatetime;

        return $this;
    }

    /**
     * Get columnDatetime
     *
     * @return \DateTime
     */
    public function getColumnDatetime()
    {
        return $this->columnDatetime;
    }

    /**
     * Set columnTime
     *
     * @param \DateTime $columnTime
     *
     * @return Columns
     */
    public function setColumnTime($columnTime)
    {
        $this->columnTime = $columnTime;

        return $this;
    }

    /**
     * Get columnTime
     *
     * @return \DateTime
     */
    public function getColumnTime()
    {
        return $this->columnTime;
    }

    /**
     * Set columnInt
     *
     * @param integer $columnInt
     *
     * @return Columns
     */
    public function setColumnInt($columnInt)
    {
        $this->columnInt = $columnInt;

        return $this;
    }

    /**
     * Get columnInt
     *
     * @return integer
     */
    public function getColumnInt()
    {
        return $this->columnInt;
    }

    /**
     * Set columnTinyint
     *
     * @param boolean $columnTinyint
     *
     * @return Columns
     */
    public function setColumnTinyint($columnTinyint)
    {
        $this->columnTinyint = $columnTinyint;

        return $this;
    }

    /**
     * Get columnTinyint
     *
     * @return boolean
     */
    public function getColumnTinyint()
    {
        return $this->columnTinyint;
    }

    /**
     * Set columnDecimal
     *
     * @param string $columnDecimal
     *
     * @return Columns
     */
    public function setColumnDecimal($columnDecimal)
    {
        $this->columnDecimal = $columnDecimal;

        return $this;
    }

    /**
     * Get columnDecimal
     *
     * @return string
     */
    public function getColumnDecimal()
    {
        return $this->columnDecimal;
    }

    /**
     * Set columnVarchar
     *
     * @param string $columnVarchar
     *
     * @return Columns
     */
    public function setColumnVarchar($columnVarchar)
    {
        $this->columnVarchar = $columnVarchar;

        return $this;
    }

    /**
     * Get columnVarchar
     *
     * @return string
     */
    public function getColumnVarchar()
    {
        return $this->columnVarchar;
    }

    /**
     * Set columnLongtext
     *
     * @param string $columnLongtext
     *
     * @return Columns
     */
    public function setColumnLongtext($columnLongtext)
    {
        $this->columnLongtext = $columnLongtext;

        return $this;
    }

    /**
     * Get columnLongtext
     *
     * @return string
     */
    public function getColumnLongtext()
    {
        return $this->columnLongtext;
    }

    /**
     * Set columnText
     *
     * @param string $columnText
     *
     * @return Columns
     */
    public function setColumnText($columnText)
    {
        $this->columnText = $columnText;

        return $this;
    }

    /**
     * Get columnText
     *
     * @return string
     */
    public function getColumnText()
    {
        return $this->columnText;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Columns
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
     * @return Columns
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
     * Set columnDatetimePtBr
     *
     * @param \DateTime $columnDatetimePtBr
     *
     * @return Columns
     */
    public function setColumnDatetimePtBr($columnDatetimePtBr)
    {
        $this->columnDatetimePtBr = $columnDatetimePtBr;

        return $this;
    }

    /**
     * Get columnDatetimePtBr
     *
     * @return \DateTime
     */
    public function getColumnDatetimePtBr()
    {
        return $this->columnDatetimePtBr;
    }

    /**
     * Set columnDatePtBr
     *
     * @param \DateTime $columnDatePtBr
     *
     * @return Columns
     */
    public function setColumnDatePtBr($columnDatePtBr)
    {
        $this->columnDatePtBr = $columnDatePtBr;

        return $this;
    }

    /**
     * Get columnDatePtBr
     *
     * @return \DateTime
     */
    public function getColumnDatePtBr()
    {
        return $this->columnDatePtBr;
    }

    /**
     * Set columnDecimalPtBr
     *
     * @param string $columnDecimalPtBr
     *
     * @return Columns
     */
    public function setColumnDecimalPtBr($columnDecimalPtBr)
    {
        $this->columnDecimalPtBr = $columnDecimalPtBr;

        return $this;
    }

    /**
     * Get columnDecimalPtBr
     *
     * @return string
     */
    public function getColumnDecimalPtBr()
    {
        return $this->columnDecimalPtBr;
    }

    /**
     * Set columnIntCheckbox
     *
     * @param integer $columnIntCheckbox
     *
     * @return Columns
     */
    public function setColumnIntCheckbox($columnIntCheckbox)
    {
        $this->columnIntCheckbox = $columnIntCheckbox;

        return $this;
    }

    /**
     * Get columnIntCheckbox
     *
     * @return integer
     */
    public function getColumnIntCheckbox()
    {
        return $this->columnIntCheckbox;
    }

    /**
     * Set columnTinyintCheckbox
     *
     * @param boolean $columnTinyintCheckbox
     *
     * @return Columns
     */
    public function setColumnTinyintCheckbox($columnTinyintCheckbox)
    {
        $this->columnTinyintCheckbox = $columnTinyintCheckbox;

        return $this;
    }

    /**
     * Get columnTinyintCheckbox
     *
     * @return boolean
     */
    public function getColumnTinyintCheckbox()
    {
        return $this->columnTinyintCheckbox;
    }

    /**
     * Set columnVarcharEmail
     *
     * @param string $columnVarcharEmail
     *
     * @return Columns
     */
    public function setColumnVarcharEmail($columnVarcharEmail)
    {
        $this->columnVarcharEmail = $columnVarcharEmail;

        return $this;
    }

    /**
     * Get columnVarcharEmail
     *
     * @return string
     */
    public function getColumnVarcharEmail()
    {
        return $this->columnVarcharEmail;
    }

    /**
     * Set columnVarcharPasswordVerify
     *
     * @param string $columnVarcharPasswordVerify
     *
     * @return Columns
     */
    public function setColumnVarcharPasswordVerify($columnVarcharPasswordVerify)
    {
        $this->columnVarcharPasswordVerify = $columnVarcharPasswordVerify;

        return $this;
    }

    /**
     * Get columnVarcharPasswordVerify
     *
     * @return string
     */
    public function getColumnVarcharPasswordVerify()
    {
        return $this->columnVarcharPasswordVerify;
    }

    /**
     * Set columnVarcharUniqueId
     *
     * @param string $columnVarcharUniqueId
     *
     * @return Columns
     */
    public function setColumnVarcharUniqueId($columnVarcharUniqueId)
    {
        $this->columnVarcharUniqueId = $columnVarcharUniqueId;

        return $this;
    }

    /**
     * Get columnVarcharUniqueId
     *
     * @return string
     */
    public function getColumnVarcharUniqueId()
    {
        return $this->columnVarcharUniqueId;
    }

    /**
     * Set columnVarcharUploadImage
     *
     * @param string $columnVarcharUploadImage
     *
     * @return Columns
     */
    public function setColumnVarcharUploadImage($columnVarcharUploadImage)
    {
        $this->columnVarcharUploadImage = $columnVarcharUploadImage;

        return $this;
    }

    /**
     * Get columnVarcharUploadImage
     *
     * @return string
     */
    public function getColumnVarcharUploadImage()
    {
        return $this->columnVarcharUploadImage;
    }

    /**
     * Set createdBy
     *
     * @param \Security\Entity\User $createdBy
     *
     * @return Columns
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
     * @return Columns
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

    /**
     * Set columnForeignKey
     *
     * @param \Column\Entity\ForeignKeys $columnForeignKey
     *
     * @return Columns
     */
    public function setColumnForeignKey(\Column\Entity\ForeignKeys $columnForeignKey = null)
    {
        $this->columnForeignKey = $columnForeignKey;

        return $this;
    }

    /**
     * Get columnForeignKey
     *
     * @return \Column\Entity\ForeignKeys
     */
    public function getColumnForeignKey()
    {
        return $this->columnForeignKey;
    }
}
