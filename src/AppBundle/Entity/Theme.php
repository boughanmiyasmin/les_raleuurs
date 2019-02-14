<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Theme
 *
 * @ORM\Table(name="theme")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ThemeRepository")
 */
class Theme
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** @var ArrayCollection
     * @ORM\OneToMany(targetEntity="PetitionBundle\Entity\Petition", mappedBy="theme")
     */
    private $petitions;

    /** @var ArrayCollection
     * @ORM\OneToMany(targetEntity="SondageBundle\Entity\Sondage", mappedBy="theme")
     */
    private $sondages;
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $theme;


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
     * Set name
     *
     * @param string $name
     *
     * @return Theme
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->name = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add name
     *
     * @param \PetitionBundle\Entity\Petition $name
     *
     * @return Theme
     */
    public function addName(\PetitionBundle\Entity\Petition $name)
    {
        $this->name[] = $name;

        return $this;
    }

    /**
     * Remove name
     *
     * @param \PetitionBundle\Entity\Petition $name
     */
    public function removeName(\PetitionBundle\Entity\Petition $name)
    {
        $this->name->removeElement($name);
    }

    /**
     * Set theme
     *
     * @param string $theme
     *
     * @return Theme
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

    /**
     * Add petition
     *
     * @param \PetitionBundle\Entity\Petition $petition
     *
     * @return Theme
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
     * Add petition
     *
     * @param \SondageBundle\Entity\Sondage $sondage
     *
     * @return Theme
     */
    public function addSondage(\SondageBundle\Entity\Sondage $sondage)
    {
        $this->sondages[] = $sondage;

        return $this;
    }

    /**
     * Remove petition
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
}
