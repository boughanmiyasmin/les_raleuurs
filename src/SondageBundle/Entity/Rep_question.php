<?php

namespace SondageBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Rep_question
 *
 * @ORM\Table(name="rep_question")
 * @ORM\Entity(repositoryClass="SondageBundle\Repository\Rep_questionRepository")
 */
class Rep_question
{

    public function __toString() {
        return $this->reponse;
    }

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
     * @ORM\Column(name="reponse", type="string", length=255)
     */
    private $reponse;

    /** @var Questions
     * @ORM\ManyToOne(targetEntity="SondageBundle\Entity\Questions", inversedBy="reponses")
     */
    private $question;


    /**
     * @ORM\OneToOne (targetEntity="SondageBundle\Entity\Rep_question_user", mappedBy="reponse")
     */
    private $user_reponses;




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
     * Set reponse
     *
     * @param string $reponse
     *
     * @return Rep_question
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;
    
        return $this;
    }

    /**
     * Get reponse
     *
     * @return string
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * Set question
     *
     * @param \SondageBundle\Entity\Questions $question
     *
     * @return Rep_question
     */
    public function setQuestion(\SondageBundle\Entity\Questions $question = null)
    {
        $this->question = $question;
    
        return $this;
    }

    /**
     * Get question
     *
     * @return \SondageBundle\Entity\Questions
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set userReponses
     *
     * @param \SondageBundle\Entity\Rep_question_user $userReponses
     *
     * @return Rep_question
     */
    public function setUserReponses(\SondageBundle\Entity\Rep_question_user $userReponses = null)
    {
        $this->user_reponses = $userReponses;
    
        return $this;
    }

    /**
     * Get userReponses
     *
     * @return \SondageBundle\Entity\Rep_question_user
     */
    public function getUserReponses()
    {
        return $this->user_reponses;
    }
}
