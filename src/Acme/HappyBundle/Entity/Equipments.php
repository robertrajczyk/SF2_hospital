<?php

namespace Acme\HappyBundle\Entity;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use APY\DataGridBundle\Grid\Mapping as GRID;

use Doctrine\ORM\Mapping as ORM;

/**
 * Equipments
 * @GRID\Source(columns="id, title, producer, typ, numbersr, numberinw, wardid.wardname, wardid.id", groupBy={"id"})
 */
class Equipments
{
    /**
     * @var string
     * @GRID\Column(field="title", title="Nazwa" ) 
     */
    private $title;

    /**
     * @var string
     * @GRID\Column(field="producer", title="Producent" ) 
     */
    private $producer;

    /**
     * @var string
     * @GRID\Column(field="typ", title="Typ" ) 
     */
    private $typ;

    /**
     * @var string
     * @GRID\Column(field="numbersr", title="Nr. Seryjny" ) 
     */
    private $numbersr;

    /**
     * @var string
     * @GRID\Column(field="numberinw", title="Nr. Inwentarzowy" ) 
     */
    private $numberinw;

    /**
     * @var \DateTime
     * @GRID\Column(field="dateofreview", title="Data przeglądu" ) 
     */
    private $dateofreview;

    /**
     * @var integer
     */
    private $inserteduser;

    /**
     * @var \DateTime
     */
    private $inserteddate;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Acme\HappyBundle\Entity\Wards
     * @GRID\Column(field="wardid.wardname", title="Oddział") 
     * @GRID\Column(field="wardid.id", title="Oddział", visible=false) 
     */
    private $wardid;


    /**
     * Set title
     *
     * @param string $title
     * @return Equipments
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
     * Set producer
     *
     * @param string $producer
     * @return Equipments
     */
    public function setProducer($producer)
    {
        $this->producer = $producer;
    
        return $this;
    }

    /**
     * Get producer
     *
     * @return string 
     */
    public function getProducer()
    {
        return $this->producer;
    }

    /**
     * Set typ
     *
     * @param string $typ
     * @return Equipments
     */
    public function setTyp($typ)
    {
        $this->typ = $typ;
    
        return $this;
    }

    /**
     * Get typ
     *
     * @return string 
     */
    public function getTyp()
    {
        return $this->typ;
    }

    /**
     * Set numbersr
     *
     * @param string $numbersr
     * @return Equipments
     */
    public function setNumbersr($numbersr)
    {
        $this->numbersr = $numbersr;
    
        return $this;
    }

    /**
     * Get numbersr
     *
     * @return string 
     */
    public function getNumbersr()
    {
        return $this->numbersr;
    }

    /**
     * Set numberinw
     *
     * @param string $numberinw
     * @return Equipments
     */
    public function setNumberinw($numberinw)
    {
        $this->numberinw = $numberinw;
    
        return $this;
    }

    /**
     * Get numberinw
     *
     * @return string 
     */
    public function getNumberinw()
    {
        return $this->numberinw;
    }

    /**
     * Set dateofreview
     *
     * @param \DateTime $dateofreview
     * @return Equipments
     */
    public function setDateofreview($dateofreview)
    {
        $this->dateofreview = $dateofreview;
    
        return $this;
    }

    /**
     * Get dateofreview
     *
     * @return \DateTime 
     */
    public function getDateofreview()
    {
        return $this->dateofreview;
    }

    /**
     * Set inserteduser
     *
     * @param integer $inserteduser
     * @return Equipments
     */
    public function setInserteduser($inserteduser)
    {
        $this->inserteduser = $inserteduser;
    
        return $this;
    }

    /**
     * Get inserteduser
     *
     * @return integer 
     */
    public function getInserteduser()
    {
        return $this->inserteduser;
    }

    /**
     * Set inserteddate
     *
     * @param \DateTime $inserteddate
     * @return Equipments
     */
    public function setInserteddate($inserteddate)
    {
        $this->inserteddate = $inserteddate;
    
        return $this;
    }

    /**
     * Get inserteddate
     *
     * @return \DateTime 
     */
    public function getInserteddate()
    {
        return $this->inserteddate;
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
     * Set wardid
     *
     * @param \Acme\HappyBundle\Entity\Wards $wardid
     * @return Equipments
     */
    public function setWardid(\Acme\HappyBundle\Entity\Wards $wardid = null)
    {
        $this->wardid = $wardid;
    
        return $this;
    }

    /**
     * Get wardid
     *
     * @return \Acme\HappyBundle\Entity\Wards 
     */
    public function getWardid()
    {
        return $this->wardid;
    }
}
