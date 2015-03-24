<?php

namespace Acme\HappyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsersToWards
 */
class UsersToWards
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Acme\HappyBundle\Entity\Wards
     */
    private $wardid;

    /**
     * @var \Acme\HappyBundle\Entity\Users
     */
    private $userid;


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
     * @return UsersToWards
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

    /**
     * Set userid
     *
     * @param \Acme\HappyBundle\Entity\Users $userid
     * @return UsersToWards
     */
    public function setUserid(\Acme\HappyBundle\Entity\Users $userid = null)
    {
        $this->userid = $userid;
    
        return $this;
    }

    /**
     * Get userid
     *
     * @return \Acme\HappyBundle\Entity\Users 
     */
    public function getUserid()
    {
        return $this->userid;
    }
}
