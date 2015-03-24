<?php

namespace Acme\HappyBundle\Entity;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use APY\DataGridBundle\Grid\Mapping as GRID;

use Doctrine\ORM\Mapping as ORM;

/**
 * Wards
 * @GRID\Source(columns="id, wardname", groupBy={"id"})
 */
class Wards
{
    /**
     * @var string
     * @GRID\Column(field="wardname", title="Nazwa Oddziału" ) 
     */
    private $wardname;

    /**
     * @var integer
     * @GRID\Column(field="id", title="Id" ) 
     */
    private $id;


    /**
     * Set wardname
     *
     * @param string $wardname
     * @return Wards
     */
    public function setWardname($wardname)
    {
        $this->wardname = $wardname;
    
        return $this;
    }

    /**
     * Get wardname
     *
     * @return string 
     */
    public function getWardname()
    {
        return $this->wardname;
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
}
