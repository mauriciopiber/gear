<?php

namespace TestUntil\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExpectedWorkingHours
 *
 * @ORM\Table(name="expected_working_hours", indexes={@ORM\Index(name="fk_expected_working_hours_1", columns={"id_weekday"}), @ORM\Index(name="created_by", columns={"created_by"}), @ORM\Index(name="updated_by", columns={"updated_by"})})
 * @ORM\Entity
 */
class ExpectedWorkingHours
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_expected_working_hours", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idExpectedWorkingHours;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_time", type="time", nullable=true)
     */
    private $startTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_time", type="time", nullable=true)
     */
    private $endTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;

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
     * @var \TestUntil\Entity\Weekday
     *
     * @ORM\ManyToOne(targetEntity="TestUntil\Entity\Weekday")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_weekday", referencedColumnName="id_weekday")
     * })
     */
    private $idWeekday;



    /**
     * Get idExpectedWorkingHours
     *
     * @return integer 
     */
    public function getIdExpectedWorkingHours()
    {
        return $this->idExpectedWorkingHours;
    }

    /**
     * Set startTime
     *
     * @param \DateTime $startTime
     * @return ExpectedWorkingHours
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime 
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     * @return ExpectedWorkingHours
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime 
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return ExpectedWorkingHours
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
     * Set created
     *
     * @param \DateTime $created
     * @return ExpectedWorkingHours
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
     * Set updatedBy
     *
     * @param \TestUntil\Entity\User $updatedBy
     * @return ExpectedWorkingHours
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
     * @return ExpectedWorkingHours
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
     * Set idWeekday
     *
     * @param \TestUntil\Entity\Weekday $idWeekday
     * @return ExpectedWorkingHours
     */
    public function setIdWeekday(\TestUntil\Entity\Weekday $idWeekday = null)
    {
        $this->idWeekday = $idWeekday;

        return $this;
    }

    /**
     * Get idWeekday
     *
     * @return \TestUntil\Entity\Weekday 
     */
    public function getIdWeekday()
    {
        return $this->idWeekday;
    }
}
