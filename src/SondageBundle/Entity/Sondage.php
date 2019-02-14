<?php

namespace SondageBundle\Entity;

use AppBundle\Entity\Theme;
use AppBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Sondage
 *
 * @ORM\Table(name="sondage")
 * @ORM\Entity(repositoryClass="SondageBundle\Repository\SondageRepository")
 */
class Sondage
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

    /** @var Theme
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Theme", inversedBy="sondages")
     */
    private $theme;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

    
    /**
    * @ORM\OneToMany(targetEntity="SondageBundle\Entity\Question", mappedBy="sondage", cascade={"persist"})
    */
    private $questions;


    /**
    * @ORM\OneToMany(targetEntity="SondageBundle\Entity\Participation", mappedBy="sondage", cascade={"persist"})
    */
    private $participations;
    /**
     *
     * @ORM\Column(name="imgg", type="string", nullable=true)
     * @Assert\File(mimeTypes={ "image/png", "image/jpg", "image/jpeg" })
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="string", length=255, nullable=true)
     */
    private $lien;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;


    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text")
     */
    private $text;


    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=100, nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="sessionId", type="string", length=255, nullable=true)
     */
    private $sessionId;
    
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
     * Set author
     *
     * @param string $author
     *
     * @return Sondage
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set theme
     *
     * @param string $theme
     *
     * @return Sondage
     */
    public function setTheme($theme)
    {
        $this->theme= $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->questions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add question
     *
     * @param \SondageBundle\Entity\Question $question
     *
     * @return Sondage
     */
    public function addQuestion(\SondageBundle\Entity\Question $question)
    {
        $question->setSondage($this);
        $this->questions[] = $question;

        return $this;
    }

    /**
     * Remove question
     *
     * @param \SondageBundle\Entity\Question $question
     */
    public function removeQuestion(\SondageBundle\Entity\Question $question)
    {
        $this->questions->removeElement($question);
    }

    /**
     * Get questions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * Add participation
     *
     * @param \SondageBundle\Entity\Participation $participation
     *
     * @return Sondage
     */
    public function addParticipation(\SondageBundle\Entity\Participation $participation)
    {
        $this->participations[] = $participation;

        return $this;
    }

    /**
     * Remove participation
     *
     * @param \SondageBundle\Entity\Participation $participation
     */
    public function removeParticipation(\SondageBundle\Entity\Participation $participation)
    {
        $this->participations->removeElement($participation);
    }

    /**
     * Get participations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParticipations()
    {
        return $this->participations;
    }




    /**
     * Set image
     *
     * @param string $image
     *
     * @return Sondage
     */
    public function setImage($image)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set lien
     *
     * @param string $lien
     *
     * @return Sondage
     */
    public function setLien($lien)
    {
        $this->lien = $lien;
    
        return $this;
    }

    /**
     * Get lien
     *
     * @return string
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Sondage
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    
        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Sondage
     */
    public function setText($text)
    {
        $this->text = $text;
    
        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set date
     *
     * @param string $date
     *
     * @return Sondage
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

    /**
     * Set sessionId
     *
     * @param string $sessionId
     *
     * @return Sondage
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

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Sondage
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
