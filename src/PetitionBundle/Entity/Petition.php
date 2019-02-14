<?php

namespace PetitionBundle\Entity;

use AppBundle\Entity\Theme;
use AppBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Tests\Model;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Petition
 *
 * @ORM\Table(name="petition")
 * @ORM\Entity(repositoryClass="PetitionBundle\Repository\PetitionRepository")
 */
class Petition
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="petitions")
     */

    private $user;

    /** @var ArrayCollection
     * @ORM\OneToMany(targetEntity="PetitionBundle\Entity\Signature", mappedBy="petition")
     */

    private $signatures;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="cree", type="string", length=255)
     */
    private $cree;

    /** @var Theme
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Theme", inversedBy="petitions")
     */
    private $theme;

    /**
     * @var string
     *
     *
     * @ORM\Column(name="n_p", type="text")
     */
    private $n_p;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;
    /**
     *
     * @ORM\Column(name="imgp", type="string",nullable=true)
     * @Assert\File(mimeTypes={ "image/png", "image/jpg", "image/jpeg" })
     */
    protected $img;


    /**
     * @return bool
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param bool $img
     */
    public function setImg($img)
    {
        $this->img = $img;
    }

    /**
     * @var string
     * @ORM\Column(name="img", type="text", nullable=true)
     */
    private $info;

    /**
     * @return string
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @param string $info
     */
    public function setInfo($info)
    {
        $this->info = $info;
    }

    /**
     * Get id
     *
     * @return int
     *
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Petition
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
     * Set cree
     *
     * @param string $cree
     *
     * @return Petition
     */
    public function setCree($cree)
    {
        $this->cree = $cree;

        return $this;
    }

    /**
     * Get cree
     *
     * @return string
     */
    public function getCree()
    {
        return $this->cree;
    }

    /**
     * Set nP
     *
     * @param string $nP
     *
     * @return Petition
     */
    public function setNP($nP)
    {
        $this->n_p = $nP;

        return $this;
    }

    /**
     * Get nP
     *
     * @return string
     */
    public function getNP()
    {
        return $this->n_p;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Petition
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->signatures = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add signature
     *
     * @param \PetitionBundle\Entity\signature $signature
     *
     * @return Petition
     */
    public function addSignature(\PetitionBundle\Entity\signature $signature)
    {
        $this->signatures[] = $signature;

        return $this;
    }

    /**
     * Remove signature
     *
     * @param \PetitionBundle\Entity\signature $signature
     */
    public function removeSignature(\PetitionBundle\Entity\signature $signature)
    {
        $this->signatures->removeElement($signature);
    }

    /**
     * Get signatures
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSignatures()
    {
        return $this->signatures;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Petition
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

    /**
     * Set theme
     *
     * @param string $theme
     *
     * @return Petition
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;

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
}
