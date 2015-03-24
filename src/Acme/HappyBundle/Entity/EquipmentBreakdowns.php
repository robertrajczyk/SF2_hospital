<?php

namespace Acme\HappyBundle\Entity;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use APY\DataGridBundle\Grid\Mapping as GRID;

use Doctrine\ORM\Mapping as ORM;

/**
 * EquipmentBreakdowns
 *
 * @ORM\Table(name="equipment_breakdowns", indexes={@ORM\Index(name="FK_e_b", columns={"equipment"})})
 * @GRID\Source(columns="id, dateOfAccident, descriptionDamage, dateOfDispatch, dataRecovery, serviceData, warranty, costs, comments, equipment.id", groupBy={"id"})
 * @ORM\Entity
 */
class EquipmentBreakdowns
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_of_accident", type="date", nullable=true )
     * @GRID\Column(field="dateOfAccident", title="Data awarii", visible=false ) 
     */
    private $dateOfAccident;

    /**
     * @var string
     *
     * @ORM\Column(name="description_damage", type="text", nullable=true)
     * @GRID\Column(field="descriptionDamage", title="Opis uszkodzenia" ) 
     */
    private $descriptionDamage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_of_dispatch", type="date", nullable=true)
     * @GRID\Column(field="dateOfDispatch", title="Data wysyłki" , visible=false) 
     */
    private $dateOfDispatch;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_recovery", type="date", nullable=true)
     * @GRID\Column(field="dataRecovery", title="Data naprawy" , visible=false) 
     */
    private $dataRecovery;

    /**
     * @var string
     *
     * @ORM\Column(name="service_data", type="string", length=255, nullable=true)
     * @GRID\Column(field="serviceData", title="Dane serwisu" ) 
     */
    private $serviceData;

    /**
     * @var string
     *
     * @ORM\Column(name="warranty", type="string", length=255, nullable=true)
     * @GRID\Column(field="warranty", title="Okres gwarancji" ) 
     */
    private $warranty;

    /**
     * @var string
     *
     * @ORM\Column(name="costs", type="string", length=255, nullable=true)
     * @GRID\Column(field="costs", title="Koszt" ) 
     */
    private $costs;

    /**
     * @var string
     *
     * @ORM\Column(name="comments", type="text", nullable=true)
     * @GRID\Column(field="comments", title="Komentarz" ) 
     */
    private $comments;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Acme\HappyBundle\Entity\Equipments
     *
     * @ORM\ManyToOne(targetEntity="Acme\HappyBundle\Entity\Equipments")
     * @GRID\Column(field="equipment.id", title="Sprzęt", visible=false)  
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="equipment", referencedColumnName="id")
     * })
     */
    private $equipment;



    /**
     * Set dateOfAccident
     *
     * @param \DateTime $dateOfAccident
     * @return EquipmentBreakdowns
     */
    public function setDateOfAccident($dateOfAccident)
    {
        $this->dateOfAccident = $dateOfAccident;
    
        return $this;
    }

    /**
     * Get dateOfAccident
     *
     * @return \DateTime 
     */
    public function getDateOfAccident()
    {
        return $this->dateOfAccident;
    }

    /**
     * Set descriptionDamage
     *
     * @param string $descriptionDamage
     * @return EquipmentBreakdowns
     */
    public function setDescriptionDamage($descriptionDamage)
    {
        $this->descriptionDamage = $descriptionDamage;
    
        return $this;
    }

    /**
     * Get descriptionDamage
     *
     * @return string 
     */
    public function getDescriptionDamage()
    {
        return $this->descriptionDamage;
    }

    /**
     * Set dateOfDispatch
     *
     * @param \DateTime $dateOfDispatch
     * @return EquipmentBreakdowns
     */
    public function setDateOfDispatch($dateOfDispatch)
    {
        $this->dateOfDispatch = $dateOfDispatch;
    
        return $this;
    }

    /**
     * Get dateOfDispatch
     *
     * @return \DateTime 
     */
    public function getDateOfDispatch()
    {
        return $this->dateOfDispatch;
    }

    /**
     * Set dataRecovery
     *
     * @param \DateTime $dataRecovery
     * @return EquipmentBreakdowns
     */
    public function setDataRecovery($dataRecovery)
    {
        $this->dataRecovery = $dataRecovery;
    
        return $this;
    }

    /**
     * Get dataRecovery
     *
     * @return \DateTime 
     */
    public function getDataRecovery()
    {
        return $this->dataRecovery;
    }

    /**
     * Set serviceData
     *
     * @param string $serviceData
     * @return EquipmentBreakdowns
     */
    public function setServiceData($serviceData)
    {
        $this->serviceData = $serviceData;
    
        return $this;
    }

    /**
     * Get serviceData
     *
     * @return string 
     */
    public function getServiceData()
    {
        return $this->serviceData;
    }

    /**
     * Set warranty
     *
     * @param string $warranty
     * @return EquipmentBreakdowns
     */
    public function setWarranty($warranty)
    {
        $this->warranty = $warranty;
    
        return $this;
    }

    /**
     * Get warranty
     *
     * @return string 
     */
    public function getWarranty()
    {
        return $this->warranty;
    }

    /**
     * Set costs
     *
     * @param string $costs
     * @return EquipmentBreakdowns
     */
    public function setCosts($costs)
    {
        $this->costs = $costs;
    
        return $this;
    }

    /**
     * Get costs
     *
     * @return string 
     */
    public function getCosts()
    {
        return $this->costs;
    }

    /**
     * Set comments
     *
     * @param string $comments
     * @return EquipmentBreakdowns
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    
        return $this;
    }

    /**
     * Get comments
     *
     * @return string 
     */
    public function getComments()
    {
        return $this->comments;
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
     * @return EquipmentBreakdowns
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
