<?php

namespace SondageBundle\Entity;

use AppBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation")
 * @ORM\Entity(repositoryClass="SondageBundle\Repository\ParticipationRepository")
 */
class Participation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** @var User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="sondages" )
     */

    private $user;
    
     /**
    * @ORM\ManyToOne(targetEntity="SondageBundle\Entity\Sondage", inversedBy="participations")
    * @ORM\JoinColumn(nullable=false)
    */
    private $sondage;

    /**
    * @ORM\OneToOne(targetEntity="SondageBundle\Entity\Choix", inversedBy="choix", cascade={"persist"})
    */
    private $choix;
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function __construct(\SondageBundle\Entity\Sondage $sondage){
        
        $this->setSondage($sondage);
        $choix = new Choix($sondage);
        $this->setChoix($choix);
        
    }

    /**
     * Set sondage
     *
     * @param \SondageBundle\Entity\Sondage $sondage
     *
     * @return Participation
     */
    public function setSondage(\SondageBundle\Entity\Sondage $sondage)
    {
        $this->sondage = $sondage;

        return $this;
    }

    /**
     * Get sondage
     *
     * @return \SondageBundle\Entity\Sondage
     */
    public function getSondage()
    {
        return $this->sondage;
    }

    /**
     * Set choix
     *
     * @param \SondageBundle\Entity\Choix $choix
     *
     * @return Participation
     */
    public function setChoix(\SondageBundle\Entity\Choix $choix)
    {
        $choix->setParticipation($this);
        $this->choix = $choix;
        
        return $this;
    }

    /**
     * Get choix
     *
     * @return \SondageBundle\Entity\Choix
     */
    public function getChoix()
    {
        return $this->choix;
    }
    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Participation
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
