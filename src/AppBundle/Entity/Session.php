<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Session
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\SessionRepository")
 */
class Session
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="date")
     */
    private $dateFin;

    /**
     * @var \String
     *
     * @ORM\Column(name="lieu", type="string", length=255)
     */
    private $lieu;

    /**
     * @var string
     *
     * @ORM\Column(name="placeRest", type="decimal")
     */
    private $placeRest;

    /**
     * Relation
     *
     *@ORM\ManyToOne(targetEntity="Formateur", inversedBy="sessions")
     *@ORM\JoinColumn(name="formateur_id", referencedColumnName="id")
     */
    protected $formateur;

    /**
     *@ORM\ManyToMany(targetEntity="Stagiaire", mappedBy="sessions")
     */
    protected $stagiaires;

    /**    
     *@ORM\ManyToOne(targetEntity="Formation", inversedBy="sessions")
     *@ORM\JoinColumn(name="formation_id", referencedColumnName="id")
     *
     */    
    protected $formation;

    /*
     * Constructeur Relations
     *
     */
    public function __construct()
    {
        $this->stagiaires = new ArrayCollection();
    }

    public function getReadableDate()
    {
        $readable = $this->dateDebut->format('d-m-Y');
        return $readable;
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
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return Session
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     * @return Session
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime 
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     * @return Session
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string 
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set placeRest
     *
     * @param string $placeRest
     * @return Session
     */
    public function setPlaceRest($placeRest)
    {
        $this->placeRest = $placeRest;

        return $this;
    }

    /**
     * Get placeRest
     *
     * @return string 
     */
    public function getPlaceRest()
    {
        return $this->placeRest;
    }

    /**
     * Set formateur
     *
     * @param \AppBundle\Entity\Formateur $formateur
     * @return Session
     */
    public function setFormateur(\AppBundle\Entity\Formateur $formateur = null)
    {
        $this->formateur = $formateur;

        return $this;
    }

    /**
     * Get formateur
     *
     * @return \AppBundle\Entity\Formateur 
     */
    public function getFormateur()
    {
        return $this->formateur;
    }

    /**
     * Add stagiaires
     *
     * @param \AppBundle\Entity\Stagiaire $stagiaires
     * @return Session
     */
    public function addStagiaire(\AppBundle\Entity\Stagiaire $stagiaires)
    {
        $this->stagiaires[] = $stagiaires;

        return $this;
    }

    /**
     * Remove stagiaires
     *
     * @param \AppBundle\Entity\Stagiaire $stagiaires
     */
    public function removeStagiaire(\AppBundle\Entity\Stagiaire $stagiaires)
    {
        $this->stagiaires->removeElement($stagiaires);
    }

    /**
     * Get stagiaires
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStagiaires()
    {
        return $this->stagiaires;
    }

    /**
     * Set formation
     *
     * @param \AppBundle\Entity\Formation $formation
     * @return Session
     */
    public function setFormation(\AppBundle\Entity\Formation $formation = null)
    {
        $this->formation = $formation;

        return $this;
    }

    /**
     * Get formation
     *
     * @return \AppBundle\Entity\Formation 
     */
    public function getFormation()
    {
        return $this->formation;
    }
}
