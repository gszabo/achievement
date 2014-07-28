<?php

namespace Achie\FrontendBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 *
 * @ORM\Table(name="Users")
 * @ORM\Entity(repositoryClass="Achie\FrontendBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\OneToMany(targetEntity="UserGotAchievement", mappedBy="user")
     * @ORM\OrderBy({"achievement" = "ASC"})
     */
    protected $achieves;

    public function __construct()
    {
        parent::__construct();
        $this->achieves = new ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->getUsername();
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
     * Set picture
     *
     * @param string $picture
     * @return User
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string 
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Add achieves
     *
     * @param \Achie\FrontendBundle\Entity\UserGotAchievement $achieves
     * @return User
     */
    public function addAchiefe(\Achie\FrontendBundle\Entity\UserGotAchievement $achieves)
    {
        $this->achieves[] = $achieves;

        return $this;
    }

    /**
     * Remove achieves
     *
     * @param \Achie\FrontendBundle\Entity\UserGotAchievement $achieves
     */
    public function removeAchiefe(\Achie\FrontendBundle\Entity\UserGotAchievement $achieves)
    {
        $this->achieves->removeElement($achieves);
    }

    /**
     * Get achieves
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAchieves()
    {
        return $this->achieves;
    }
}
