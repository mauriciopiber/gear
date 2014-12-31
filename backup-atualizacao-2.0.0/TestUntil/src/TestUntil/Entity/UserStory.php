<?php

namespace TestUntil\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserStory
 *
 * @ORM\Table(name="user_story", indexes={@ORM\Index(name="fk_user_story_1", columns={"id_project"}), @ORM\Index(name="created_by", columns={"created_by"}), @ORM\Index(name="updated_by", columns={"updated_by"})})
 * @ORM\Entity
 */
class UserStory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_user_story", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUserStory;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100, nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="registration_date", type="datetime", nullable=true)
     */
    private $registrationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deadline_date", type="datetime", nullable=true)
     */
    private $deadlineDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="estimated_time", type="integer", nullable=true)
     */
    private $estimatedTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="effective_time", type="integer", nullable=true)
     */
    private $effectiveTime;

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
     * @var \TestUntil\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="TestUntil\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="updated_by", referencedColumnName="id_user")
     * })
     */
    private $updatedBy;

    /**
     * @var \TestUntil\Entity\Project
     *
     * @ORM\ManyToOne(targetEntity="TestUntil\Entity\Project")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_project", referencedColumnName="id_project")
     * })
     */
    private $idProject;

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
     * Get idUserStory
     *
     * @return integer 
     */
    public function getIdUserStory()
    {
        return $this->idUserStory;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return UserStory
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return UserStory
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set registrationDate
     *
     * @param \DateTime $registrationDate
     * @return UserStory
     */
    public function setRegistrationDate($registrationDate)
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    /**
     * Get registrationDate
     *
     * @return \DateTime 
     */
    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }

    /**
     * Set deadlineDate
     *
     * @param \DateTime $deadlineDate
     * @return UserStory
     */
    public function setDeadlineDate($deadlineDate)
    {
        $this->deadlineDate = $deadlineDate;

        return $this;
    }

    /**
     * Get deadlineDate
     *
     * @return \DateTime 
     */
    public function getDeadlineDate()
    {
        return $this->deadlineDate;
    }

    /**
     * Set estimatedTime
     *
     * @param integer $estimatedTime
     * @return UserStory
     */
    public function setEstimatedTime($estimatedTime)
    {
        $this->estimatedTime = $estimatedTime;

        return $this;
    }

    /**
     * Get estimatedTime
     *
     * @return integer 
     */
    public function getEstimatedTime()
    {
        return $this->estimatedTime;
    }

    /**
     * Set effectiveTime
     *
     * @param integer $effectiveTime
     * @return UserStory
     */
    public function setEffectiveTime($effectiveTime)
    {
        $this->effectiveTime = $effectiveTime;

        return $this;
    }

    /**
     * Get effectiveTime
     *
     * @return integer 
     */
    public function getEffectiveTime()
    {
        return $this->effectiveTime;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return UserStory
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
     * @return UserStory
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
     * Set updatedBy
     *
     * @param \TestUntil\Entity\User $updatedBy
     * @return UserStory
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
     * Set idProject
     *
     * @param \TestUntil\Entity\Project $idProject
     * @return UserStory
     */
    public function setIdProject(\TestUntil\Entity\Project $idProject = null)
    {
        $this->idProject = $idProject;

        return $this;
    }

    /**
     * Get idProject
     *
     * @return \TestUntil\Entity\Project 
     */
    public function getIdProject()
    {
        return $this->idProject;
    }

    /**
     * Set createdBy
     *
     * @param \TestUntil\Entity\User $createdBy
     * @return UserStory
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
}
