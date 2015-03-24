<?php

namespace Acme\HappyBundle\Entity;
 
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

use APY\DataGridBundle\Grid\Mapping as GRID;

/**
 * Acme\ServiceBundle\Entity\Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="Acme\ServiceBundle\Repository\UsersRepository")
 * @GRID\Source(columns="id, username, pass, active", groupBy={"id"})
 */
class Users implements AdvancedUserInterface
{

	function isAccountNonExpired(){
		return true;
	}

	function isAccountNonLocked(){
		return true;	
	}
	
	function isCredentialsNonExpired(){
		return true;	
	}
	
	function isEnabled(){
		return $this->active;
	}
	
    public function __toString()
    {
        return $this->username;
    }
    /**
     * @var bigint $id
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $username
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=true)
     */
    private $username;

    /**
     * @var string $password
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     */
    private $password;
 
    /**
     * @var string $salt
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=true)
     */
    private $salt;

    /**
     * @var string $pass
     *
     * @ORM\Column(name="pass", type="string", length=255, nullable=true)
     */
    private $pass;

    /**
     * @var string $facebook
     *
     * @ORM\Column(name="facebook", type="string", length=255, nullable=true)
     */
    private $facebook;

    /**
     * @var string $mail
     *
     * @ORM\Column(name="mail", type="string", length=255, nullable=true)
     */
    private $mail;

    /**
     * @var string $lang
     *
     * @ORM\Column(name="lang", type="string", length=5, nullable=true)
     */
    private $lang;

    /**
     * @var integer $active
     *
     * @ORM\Column(name="active", type="integer", length=5, nullable=true)
     */
    private $active;

    /**
     * @var string $twitter
     *
     * @ORM\Column(name="twitter", type="string", length=255, nullable=true)
     */
    private $twitter;

    /**
     * @var datetime $created
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;

    /**
     * @var integer $logout
     *
     * @ORM\Column(name="logout", type="integer", length=5, nullable=true)
     */
    private $logout;

    /**
     * @var array
     */
    protected $roles = [];
	
    /**
     * Get id
     *
     * @return bigint 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set roles
     *
     * @param string $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    /**
     * Get roles
     *
     * @return string 
     */
    public function getRoles()
    {
       return array($this->roles);
    }

	/**
     * Get roles
     *
     * @return string 
     */
    public function getRole()
    {
       return  $this->roles ;
    }
	
    /**
     * Set salt
     *
     * @param string $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set pass
     *
     * @param string $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    /**
     * Get pass
     *
     * @return string 
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;
    }

    /**
     * Get facebook
     *
     * @return string 
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set mail
     *
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set lang
     *
     * @param string $lang
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
    }

    /**
     * Get lang
     *
     * @return string 
     */
    public function getLang()
    {
        return $this->lang;
    }

	/**
     * Get active
     *
     * @return int
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set active
     *
     * @param int $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
    }

    /**
     * Get twitter
     *
     * @return string 
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set created
     *
     * @param datetime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * Get created
     *
     * @return datetime 
     */
    public function getCreated()
    {
        return $this->created;
    }

	/**
     * Get logout
     *
     * @return int
     */
    public function getLogout()
    {
        return $this->logout;
    }

    /**
     * Set logout
     *
     * @param int $logout
     */
    public function setLogout($logout)
    {
        $this->logout = $logout;
    }
	
    /**
     * Erases the user credentials.
     */
    public function eraseCredentials()
    {
 
    }

	/**
     * Compares this user to another to determine if they are the same.
     * 
     * @param UserInterface $user The user
     * @return boolean True if equal, false othwerwise.
     */
    public function equals(UserInterface $user)
    {
        return ($this->getUsername() == $user->getUsername());
    }
	
	public function isGranted($role)
    {
		print_r($this->getRoles());
        return in_array($role, $this->getRoles());
    }
	
    /**
     * Get role
     *
     * @return  string 
     */
    public function getRoleFuck()
    { 
        return $this->roles;
    }
	
	/**
     * @return array
     */
    public function getRolesName()
    {
        if(!$this->roles)
        {
            $this->roles = array_map(function($a){return $a->getWardname();}, $this->getRole()->toArray());
        }
		//print_r( $this->roles);
        return $this->roles;
    }
	
}