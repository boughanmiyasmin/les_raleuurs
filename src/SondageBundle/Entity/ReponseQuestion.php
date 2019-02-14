<?php

namespace SondageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReponseQuestion
 *
 * @ORM\Table(name="reponse_question")
 * @ORM\Entity(repositoryClass="SondageBundle\Repository\ReponseQuestionRepository")
 */
class ReponseQuestion
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
    * @ORM\ManyToOne(targetEntity="SondageBundle\Entity\Choix", inversedBy="choix", cascade={"persist"})
    * @ORM\JoinColumn(nullable=false)
    */
    private $choix;
    
    /**
    * @ORM\ManyToOne(targetEntity="SondageBundle\Entity\Question", inversedBy="question", cascade={"persist"})
    */
    private $question;
    
    /**
    * @ORM\ManyToOne(targetEntity="SondageBundle\Entity\Reponse", inversedBy="reponse", cascade={"persist"})
    */
    private $reponse;

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
     * Set choix
     *
     * @param \SondageBundle\Entity\Choix $choix
     *
     * @return ReponseQuestion
     */
    public function setChoix(\SondageBundle\Entity\Choix $choix)
    {
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
     * Set question
     *
     * @param \SondageBundle\Entity\Question $question
     *
     * @return ReponseQuestion
     */
    public function setQuestion(\SondageBundle\Entity\Question $question)
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
     * Set reponse
     *
     * @param \SondageBundle\Entity\Reponse $reponse
     *
     * @return ReponseQuestion
     */
    public function setReponse(\SondageBundle\Entity\Reponse $reponse)
    {
        $this->reponse = $reponse;

        return $this;
    }

    /**
     * Get reponse
     *
     * @return \SondageBundle\Entity\Reponse
     */
    public function getReponse()
    {
        return $this->reponse;
    }
    /**
     * Constructor
     */
    public function __construct(\SondageBundle\Entity\Question $question, \SondageBundle\Entity\Choix $choix)
    {
        $this->setQuestion($question);
        $this->setChoix($choix);
    }

    /**
     * Add question
     *
     * @param \SondageBundle\Entity\Question $question
     *
     * @return ReponseQuestion
     */
    public function addQuestion(\SondageBundle\Entity\Question $question)
    {
        $this->question[] = $question;

        return $this;
    }

    /**
     * Remove question
     *
     * @param \SondageBundle\Entity\Question $question
     */
    public function removeQuestion(\SondageBundle\Entity\Question $question)
    {
        $this->question->removeElement($question);
    }

    /**
     * Add reponse
     *
     * @param \SondageBundle\Entity\Reponse $reponse
     *
     * @return ReponseQuestion
     */
    public function addReponse(\SondageBundle\Entity\Reponse $reponse)
    {
        $this->reponse[] = $reponse;

        return $this;
    }

    /**
     * Remove reponse
     *
     * @param \SondageBundle\Entity\Reponse $reponse
     */
    public function removeReponse(\SondageBundle\Entity\Reponse $reponse)
    {
        $this->reponse->removeElement($reponse);
    }
}
