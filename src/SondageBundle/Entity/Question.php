<?php

namespace SondageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity(repositoryClass="SondageBundle\Repository\QuestionRepository")
 */
class Question
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
    * @ORM\ManyToOne(targetEntity="SondageBundle\Entity\Sondage", inversedBy="questions")
    * @ORM\JoinColumn(nullable=false)
    */
    private $sondage;

    /**
     * @var string
     *
     * @ORM\Column(name="questionText", type="string", length=255)
     */
    private $questionText;

    
    /**
    * @ORM\OneToMany(targetEntity="SondageBundle\Entity\Reponse", mappedBy="question", cascade={"persist"})
    * @ORM\JoinColumn(nullable=false)
    */
    private $reponses;

    /**
    * @ORM\OneToMany(targetEntity="SondageBundle\Entity\ReponseQuestion", mappedBy="question", cascade={"persist"})
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
     * Set questionText
     *
     * @param string $questionText
     *
     * @return Question
     */
    public function setQuestionText($questionText)
    {
        $this->questionText = $questionText;

        return $this;
    }

    /**
     * Get questionText
     *
     * @return string
     */
    public function getQuestionText()
    {
        return $this->questionText;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reponses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set sondage
     *
     * @param \SondageBundle\Entity\Sondage $sondage
     *
     * @return Question
     */
    public function setSondage(\SondageBundle\Entity\Sondage $sondage = null)
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
     * Add reponse
     *
     * @param \SondageBundle\Entity\Reponse $reponse
     *
     * @return Question
     */
    public function addReponse(\SondageBundle\Entity\Reponse $reponse)
    {
        $reponse->setQuestion($this);
        $this->reponses[] = $reponse;

        return $this;
    }

    /**
     * Remove reponse
     *
     * @param \SondageBundle\Entity\Reponse $reponse
     */
    public function removeReponse(\SondageBundle\Entity\Reponse $reponse)
    {
        $this->reponses->removeElement($reponse);
    }

    /**
     * Get reponses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReponses()
    {
        return $this->reponses;
    }

    /**
     * Add reponseQuestion
     *
     * @param \SondageBundle\Entity\reponseQuestion $reponseQuestion
     *
     * @return Question
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
