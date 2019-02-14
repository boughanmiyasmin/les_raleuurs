<?php

namespace SondageBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Questions
 *
 * @ORM\Table(name="questions")
 * @ORM\Entity(repositoryClass="SondageBundle\Repository\QuestionsRepository")
 */
class Questions
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
     * @var string
     *
     * @ORM\Column(name="question", type="string", length=255)
     *
     */
    private $question;

    /** @var Sondage
     * @ORM\ManyToOne(targetEntity="SondageBundle\Entity\Sondage", inversedBy="questions")
     */
    private $sondage;

    /** @var ArrayCollection
     * @ORM\OneToMany(targetEntity="SondageBundle\Entity\Rep_question", mappedBy="question")
     */
    private $reponses;


    /** @var ArrayCollection
     * @ORM\OneToMany(targetEntity="SondageBundle\Entity\Rep_question_user", mappedBy="question")
     */
    private $user_questions;

    /**
     * @var string
     *
     * @ORM\Column(name="sessionId", type="string", length=255, nullable=true)
     */
    private $sessionId;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reponses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->user_questions = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set question
     *
     * @param string $question
     *
     * @return Questions
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    
        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set sondage
     *
     * @param \SondageBundle\Entity\Sondage $sondage
     *
     * @return Questions
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
     * @param \SondageBundle\Entity\Rep_question $reponse
     *
     * @return Questions
     */
    public function addReponse(\SondageBundle\Entity\Rep_question $reponse)
    {
        $this->reponses[] = $reponse;
    
        return $this;
    }

    /**
     * Remove reponse
     *
     * @param \SondageBundle\Entity\Rep_question $reponse
     */
    public function removeReponse(\SondageBundle\Entity\Rep_question $reponse)
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
     * Add userQuestion
     *
     * @param \SondageBundle\Entity\Rep_question_user $userQuestion
     *
     * @return Questions
     */
    public function addUserQuestion(\SondageBundle\Entity\Rep_question_user $userQuestion)
    {
        $this->user_questions[] = $userQuestion;
    
        return $this;
    }

    /**
     * Remove userQuestion
     *
     * @param \SondageBundle\Entity\Rep_question_user $userQuestion
     */
    public function removeUserQuestion(\SondageBundle\Entity\Rep_question_user $userQuestion)
    {
        $this->user_questions->removeElement($userQuestion);
    }

    /**
     * Get userQuestions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserQuestions()
    {
        return $this->user_questions;
    }

    /**
     * Set sessionId
     *
     * @param string $sessionId
     *
     * @return Questions
     */
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;
    
        return $this;
    }

    /**
     * Get sessionId
     *
     * @return string
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }
}
