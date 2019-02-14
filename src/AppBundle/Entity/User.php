<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Messages_OtO", mappedBy="fromUser")
     */
    private $messages;

    /** @var ArrayCollection
     * @ORM\OneToMany(targetEntity="PetitionBundle\Entity\Petition", mappedBy="user")
     */

    private $petitions;


    /** @var ArrayCollection
     * @ORM\OneToMany(targetEntity="SondageBundle\Entity\Sondage", mappedBy="user")
     */

    private $sondages;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */

    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */

    private $facebookId;

    private $facebookAccessToken;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */

    private $googleId;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var integer
     *
     * @ORM\Column(name="tel", type="integer", length=255)
     */
    private $telephone;



    /**
     * @var integer
     *
     * @ORM\Column(name="cp", type="integer", length=255)
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var integer
     *
     * @ORM\Column(name="age", type="integer", length=10)
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="prof", type="string", length=255)
     */
    private $profession;
    /**
     *
     * @ORM\Column(name="img", type="string", nullable=true)
     * @Assert\File(mimeTypes={ "image/png", "image/jpg", "image/jpeg" })
     */
    protected $imageFile;

    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
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
     * @return User
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
     * Set telephone
     *
     * @param integer $telephone
     *
     * @return User
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
     * Set cp
     *
     * @param integer $cp
     *
     * @return User
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
     * Set adresse
     *
     * @param string $adresse
     *
     * @return User
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return User
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
     * Set age
     *
     * @param integer $age
     *
     * @return User
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
     * @return User
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
     * Add petition
     *
     * @param \PetitionBundle\Entity\Petition $petition
     *
     * @return User
     */
    public function addPetition(\PetitionBundle\Entity\Petition $petition)
    {
        $this->petitions[] = $petition;

        return $this;
    }

    /**
     * Remove petition
     *
     * @param \PetitionBundle\Entity\Petition $petition
     */
    public function removePetition(\PetitionBundle\Entity\Petition $petition)
    {
        $this->petitions->removeElement($petition);
    }

    /**
     * Get petitions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPetitions()
    {
        return $this->petitions;
    }

    /**
     * Add sondage
     *
     * @param \SondageBundle\Entity\Sondage $sondage
     *
     * @return User
     */
    public function addSondage(\SondageBundle\Entity\Sondage $sondage)
    {
        $this->sondages[] = $sondage;

        return $this;
    }

    /**
     * Remove sondage
     *
     * @param \SondageBundle\Entity\Sondage $sondage
     */
    public function removeSondage(\SondageBundle\Entity\Sondage $sondage)
    {
        $this->sondages->removeElement($sondage);
    }

    /**
     * Get sondages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSondages()
    {
        return $this->sondages;
    }

    /**
     * Set imageFile
     *
     * @param string $imageFile
     *
     * @return User
     */
    public function setImageFile($imageFile)
    {
        $this->imageFile = $imageFile;

        return $this;
    }

    /**
     * Get imageFile
     *
     * @return string
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Add message
     *
     * @param \AppBundle\Entity\Messages_OtO $message
     *
     * @return User
     */
    public function addMessage(Messages_OtO $message)
    {
        $this->messages[] = $message;

        return $this;
    }

    /**
     * Remove message
     *
     * @param \AppBundle\Entity\Messages_OtO $message
     */
    public function removeMessage(Messages_OtO $message)
    {
        $this->messages->removeElement($message);
    }

    /**
     * Get messages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Set facebookId
     *
     * @param string $facebookId
     *
     * @return User
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;

        return $this;
    }

    /**
     * Get facebookId
     *
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * Set googleId
     *
     * @param string $googleId
     *
     * @return User
     */
    public function setGoogleId($googleId)
    {
        $this->googleId = $googleId;

        return $this;
    }

    /**
     * Get googleId
     *
     * @return string
     */
    public function getGoogleId()
    {
        return $this->googleId;
    }

    public function setFacebookAccessToken($facebookAccessToken)
    {
        $this->facebookAccessToken = $facebookAccessToken;

        return $this;
    }

    /**
     * @return string
     */
    public function getFacebookAccessToken()
    {
        return $this->facebookAccessToken;
    }
}
