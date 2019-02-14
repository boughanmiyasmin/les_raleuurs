<?php

namespace PetitionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Signature
 *
 * @ORM\Table(name="signature")
 * @ORM\Entity(repositoryClass="PetitionBundle\Repository\SignatureRepository")
 */
class Signature
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** @var Petition
     * @ORM\ManyToOne(targetEntity="PetitionBundle\Entity\Petition", inversedBy="signatures")
     */

    private $petition;
    /**
     * @var string
     *
     * @ORM\Column(name="idsession", type="string", length=255)
     */
    private $idsession;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255)
     */
    private $mail;

    /**
     * @var int
     *
     * @ORM\Column(name="telephone", type="integer")
     */
    private $telephone;
    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=255)
     */
    private $cp;

    /**
     * @var bool
     *
     * @ORM\Column(name="annonyme", type="boolean")
     */
    private $annonyme;

    /**
     * @var string
     *
     * @ORM\Column(name="petition_q", type="string", nullable=true)
     */
    private $petition_q;

    /**
     * @var string
     *
     * @ORM\Column(name="age", type="string", nullable=true)
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="profession", type="string", length=255, nullable=true)
     */
    private $profession;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=true)
     */
    private $message;

    /**
     * @var bool
     *
     * @ORM\Column(name="engagement", type="boolean")
     */
    private $engagement;

    /**
     * @var string
     *
     * @ORM\Column(name="complement1", type="string", length=255, nullable=true)
     */
    private $complement1;

    /**
     * @var string
     *
     * @ORM\Column(name="complement2", type="string", length=255, nullable=true)
     */
    private $complement2;


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
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Signature
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
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Signature
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Signature
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
     * @return Signature
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
     * @return Signature
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return int
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
     * @return Signature
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
     * @param string $cp
     *
     * @return Signature
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return string
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set annonyme
     *
     * @param boolean $annonyme
     *
     * @return Signature
     */
    public function setAnnonyme($annonyme)
    {
        $this->annonyme = $annonyme;

        return $this;
    }

    /**
     * Get annonyme
     *
     * @return bool
     */
    public function getAnnonyme()
    {
        return $this->annonyme;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return Signature
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return int
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
     * @return Signature
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
     * @return Signature
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
     * @return Signature
     */
    public function setEngagement($engagement)
    {
        $this->engagement = $engagement;

        return $this;
    }

    /**
     * Get engagement
     *
     * @return bool
     */
    public function getEngagement()
    {
        return $this->engagement;
    }

    /**
     * Set complement1
     *
     * @param string $complement1
     *
     * @return Signature
     */
    public function setComplement1($complement1)
    {
        $this->complement1 = $complement1;

        return $this;
    }

    /**
     * Get complement1
     *
     * @return string
     */
    public function getComplement1()
    {
        return $this->complement1;
    }

    /**
     * Set complement2
     *
     * @param string $complement2
     *
     * @return Signature
     */
    public function setComplement2($complement2)
    {
        $this->complement2 = $complement2;

        return $this;
    }

    /**
     * Get complement2
     *
     * @return string
     */
    public function getComplement2()
    {
        return $this->complement2;
    }

    /**
     * Set petition
     *
     * @param \PetitionBundle\Entity\Petition $petition
     *
     * @return Signature
     */
    public function setPetition(\PetitionBundle\Entity\Petition $petition = null)
    {
        $this->petition = $petition;

        return $this;
    }

    /**
     * Get petition
     *
     * @return \PetitionBundle\Entity\Petition
     */
    public function getPetition()
    {
        return $this->petition;
    }

    /**
     * Set petitionQ
     *
     * @param boolean $petitionQ
     *
     * @return Signature
     */
    public function setPetitionQ($petitionQ)
    {
        $this->petition_q = $petitionQ;

        return $this;
    }

    /**
     * Get petitionQ
     *
     * @return boolean
     */
    public function getPetitionQ()
    {
        return $this->petition_q;
    }


    /**
     * Set idsession
     *
     * @param string $idsession
     *
     * @return Signature
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
}
