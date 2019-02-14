<?php

namespace SondageBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
/**
 * Rep_question_user
 *
 * @ORM\Table(name="rep_question_user")
 * @ORM\Entity(repositoryClass="SondageBundle\Repository\Rep_question_userRepository")
 */
class Rep_question_user
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;




    /** @var questions
     * @ORM\ManyToOne(targetEntity="SondageBundle\Entity\Questions", inversedBy="user_questions")
     * @JoinColumn(name="question_id", referencedColumnName="id")
     */
    private $question;

    /**
     * @ORM\OneToOne(targetEntity="SondageBundle\Entity\Rep_question", inversedBy="user_reponses")
     * @JoinColumn(name="reponse_id", referencedColumnName="id")
     */
    private $reponse;


    /**
     * @var string
     *
     * @ORM\Column(name="idsession", type="string", length=255)
     */
    private $idsession;


    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255)
     */
    private $mail;


    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=255, nullable=true)
     */
    private $date;



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
     * @param \SondageBundle\Entity\Questions $question
     *
     * @return Rep_question_user
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
     * Set reponse
     *
     * @param \SondageBundle\Entity\Rep_question $reponse
     *
     * @return Rep_question_user
     */
    public function setReponse(\SondageBundle\Entity\Rep_question $reponse = null)
    {
        $this->reponse = $reponse;
    
        return $this;
    }

    /**
     * Get reponse
     *
     * @return \SondageBundle\Entity\Rep_question
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * Set idsession
     *
     * @param string $idsession
     *
     * @return Rep_question_user
     */
    public function setIdsession($idsession)
    {
        $this->idsession = $idsession;
    
        return $this;
    }

    /**
     * Get idsession
     *
     * @return string
     */
    public function getIdsession()
    {
        return $this->idsession;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Rep_question_user
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    
        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Rep_question_user
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Rep_question_user
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
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
     * Set telephone
     *
     * @param integer $telephone
     *
     * @return Rep_question_user
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    
        return $this;
    }

    /**
     * Get telephone
     *
     * @return integer
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Rep_question_user
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    
        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set cp
     *
     * @param integer $cp
     *
     * @return Rep_question_user
     */
    public function setCp($cp)
    {
        $this->cp = $cp;
    
        return $this;
    }

    /**
     * Get cp
     *
     * @return integer
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return Rep_question_user
     */
    public function setAge($age)
    {
        $this->age = $age;
    
        return $this;
    }

    /**
     * Get age
     *
     * @return integer
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set profession
     *
     * @param string $profession
     *
     * @return Rep_question_user
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;
    
        return $this;
    }

    /**
     * Get profession
     *
     * @return string
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Rep_question_user
     */
    public function setMessage($message)
    {
        $this->message = $message;
    
        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set engagement
     *
     * @param boolean $engagement
     *
     * @return Rep_question_user
     */
    public function setEngagement($engagement)
    {
        $this->engagement = $engagement;
    
        return $this;
    }

    /**
     * Get engagement
     *
     * @return boolean
     */
    public function getEngagement()
    {
        return $this->engagement;
    }

    /**
     * Set date
     *
     * @param string $date
     *
     * @return Rep_question_user
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }
}
