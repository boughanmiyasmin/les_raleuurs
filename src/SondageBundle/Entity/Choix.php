<?php

namespace SondageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use SondageBundle\Entity\Sondage;
use SondageBundle\Entity\Participation;
use SondageBundle\Entity\ReponseQuestion;

/**
 * Choix
 *
 * @ORM\Table(name="choix")
 * @ORM\Entity(repositoryClass="SondageBundle\Repository\ChoixRepository")
 */
class Choix
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
    * @ORM\OneToOne(targetEntity="SondageBundle\Entity\Participation", mappedBy="participation", cascade={"persist"})
    * @ORM\JoinColumn(nullable=false)
    */
    private $participation;
    
    /**
    * @ORM\OneToMany(targetEntity="SondageBundle\Entity\ReponseQuestion", mappedBy="choix", cascade={"persist"})
    * @ORM\JoinColumn(nullable=false)
    */
    private $reponseQuestions;
    
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Constructor
     */
    public function __construct(\SondageBundle\Entity\Sondage $sondage)
    {
        $this->reponseQuestions = new \Doctrine\Common\Collections\ArrayCollection();
        
        foreach ($sondage->getQuestions() as $question){            
            $this->addReponseQuestion(new ReponseQuestion($question, $this));
        }
          
    }

    /**
     * Set participation
     *
     * @param \SondageBundle\Entity\Participation $participation
     *
     * @return Choix
     */
    public function setParticipation(\SondageBundle\Entity\Participation $participation)
    {
        $this->participation = $participation;

        return $this;
    }

    /**
     * Get participation
     *
     * @return \SondageBundle\Entity\Participation
     */
    public function getParticipation()
    {
        return $this->participation;
    }

    /**
     * Add reponseQuestion
     *
     * @param \SondageBundle\Entity\ReponseQuestion $reponseQuestion
     *
     * @return Choix
     */
    public function addReponseQuestion(\SondageBundle\Entity\ReponseQuestion $reponseQuestion)
    {
        
        $this->reponseQuestions[] = $reponseQuestion;
        //$reponseQuestion->setChoix($this);

        return $this;
    }

    /**
     * Remove reponseQuestion
     *
     * @param \SondageBundle\Entity\ReponseQuestion $reponseQuestion
     */
    public function removeReponseQuestion(\SondageBundle\Entity\ReponseQuestion $reponseQuestion)
    {
        $this->reponseQuestions->removeElement($reponseQuestion);
    }

    /**
     * Get reponseQuestions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReponseQuestions()
    {
        return $this->reponseQuestions;
    }
}
