<?php

namespace Acme\HappyBundle\Entity;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use APY\DataGridBundle\Grid\Mapping as GRID;

use Doctrine\ORM\Mapping as ORM;

/**
 * EquipmentReviews
 *
 * @ORM\Table(name="equipment_reviews", indexes={@ORM\Index(name="FK_eq_rew", columns={"equipment"})})
 * @GRID\Source(columns="id, employee, reviewdate, description, equipment.id", groupBy={"id"})
 * @ORM\Entity
 */
class EquipmentReviews
{
    /**
     * @var string
     *
     * @ORM\Column(name="employee", type="string", length=255, nullable=false)
     * @GRID\Column(field="employee", title="Wykonał" ) 
     */
    private $employee;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="reviewdate", type="date", nullable=false )
     * @GRID\Column(field="reviewdate", title="Data przeglądu", visible=false ) 
     */
    private $reviewdate;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     * @GRID\Column(field="description", title="Opis" ) 
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @GRID\Column(field="id", title="Id" ) 
     */
    private $id;

    /**
     * @var \Acme\HappyBundle\Entity\Equipments
     *
     * @ORM\ManyToOne(targetEntity="Acme\HappyBundle\Entity\Equipments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="equipment", referencedColumnName="id")
     * })
     * @GRID\Column(field="equipment.id", title="Sprzęt", visible=false)  
     */
    private $equipment;



    /**
     * Set employee
     *
     * @param string $employee
     * @return EquipmentReviews
     */
    public function setEmployee($employee)
    {
        $this->employee = $employee;
    
        return $this;
    }

    /**
     * Get employee
     *
     * @return string 
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * Set reviewdate
     *
     * @param \DateTime $reviewdate
     * @return EquipmentReviews
     */
    public function setReviewdate($reviewdate)
    {
        $this->reviewdate = $reviewdate;
    
        return $this;
    }

    /**
     * Get reviewdate
     *
     * @return \DateTime 
     */
    public function getReviewdate()
    {
        return $this->reviewdate;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return EquipmentReviews
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set equipment
     *
     * @param \Acme\HappyBundle\Entity\Equipments $equipment
     * @return EquipmentReviews
     */
    public function setEquipment(\Acme\HappyBundle\Entity\Equipments $equipment = null)
    {
        $this->equipment = $equipment;
    
        return $this;
    }

    /**
     * Get equipment
     *
     * @return \Acme\HappyBundle\Entity\Equipments 
     */
    public function getEquipment()
    {
        return $this->equipment;
    }
}
