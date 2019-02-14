<?php

namespace SondageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reponse
 *
 * @ORM\Table(name="reponse")
 * @ORM\Entity(repositoryClass="SondageBundle\Repository\ReponseRepository")
 */
class Reponse
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
    * @ORM\ManyToOne(targetEntity="SondageBundle\Entity\Question", inversedBy="reponses")
    * @ORM\JoinColumn(nullable=false)
    */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="reponseText", type="string", length=255)
     */
    private $reponseText;
    
    
    /**
    * @ORM\OneToMany(targetEntity="SondageBundle\Entity\ReponseQuestion", mappedBy="reponse", cascade={"persist"})
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
     * Set reponseText
     *
     * @param string $reponseText
     *
     * @return Reponse
     */
    public function setReponseText($reponseText)
    {
        $this->reponseText = $reponseText;

        return $this;
    }

    /**
     * Get reponseText
     *
     * @return string
     */
    public function getReponseText()
    {
        return $this->reponseText;
    }

    /**
     * Set question
     *
     * @param \SondageBundle\Entity\Question $question
     *
     * @return Reponse
     */
    public function setQuestion(\SondageBundle\Entity\Question $question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \SondageBundle\Entity\Question
     */
    public function getQuestion()
    {
        return $this->question;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reponseQuestions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add reponseQuestion
     *
     * @param \SondageBundle\Entity\reponseQuestion $reponseQuestion
     *
     * @return Reponse
     */
    public function addReponseQuestion(\SondageBundle\Entity\reponseQuestion $reponseQuestion)
    {
        $this->reponseQuestions[] = $reponseQuestion;

        return $this;
    }

    /**
     * Remove reponseQuestion
     *
     * @param \SondageBundle\Entity\reponseQuestion $reponseQuestion
     */
    public function removeReponseQuestion(\SondageBundle\Entity\reponseQuestion $reponseQuestion)
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
