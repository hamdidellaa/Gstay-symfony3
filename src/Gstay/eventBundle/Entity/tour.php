<?php
/**
 * Created by PhpStorm.
 * User: HD_EXECUTION
 * Date: 10/02/2017
 * Time: 02:02
 */

namespace Gstay\eventBundle\Entity;
use AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM ;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity
 * @ORM\Table(name="tour")
 * @ORM\Entity(repositoryClass="Gstay\eventBundle\Entity\EventRepository")
 * @Vich\Uploadable
 */
class tour
{

    /**
     * @ORM\Id
     * @ORM\Column(type="string",length=256)
     */
    private $id ;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="tour")
     * @ORM\JoinColumn(name="id_organisateur", referencedColumnName="id")
     */
    private $id_organisateur ;

    /**
     * @ORM\Column(type="string",length=256,nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string",length=5000,nullable=true)
     */
    private $description;
    /**
     * @ORM\Column(type="string",length=5000,nullable=true)
     */
    private $opt_activity;

    /**
     * @ORM\Column(type="string",length=5000,nullable=true)
     */
    private $accomodation;


    /**
     * @ORM\Column(type="string",length=5000,nullable=true)
     */
    private $tips;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $maxplace;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $prix;

    /**
     * @ORM\Column(type="date")
     */
    private $datedebut;

    /**
     * @ORM\Column(type="date")
     */
    private $datefin;

    /**
     *@ORM\Column(type="string",length=255,options={"default" : "actif"})
     */
    private $statut;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $nbdays;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="imageName")
     *
     * @var File
     */
    private $imageFile;
    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;


    /**
     *@ORM\Column(type="integer",nullable=true,options={"default" : "0"})
     */
    private $ticketvendu;

    /**
     * @return mixed
     */
    public function getTicketvendu()
    {
        return $this->ticketvendu;
    }

    /**
     * @param mixed $ticketvendu
     */
    public function setTicketvendu($ticketvendu)
    {
        $this->ticketvendu = $ticketvendu;
    }




    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Product
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }


    /**
     * @return File|null
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param string $imageName
     *
     * @return Product
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageName()
    {
        return $this->imageName;
    }






    /**
     * @return mixed
     */
    public function getNbdays()
    {
        return $this->nbdays;
    }

    /**
     * @param mixed $nbdays
     */
    public function setNbdays($nbdays)
    {
        $this->nbdays = $nbdays;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param mixed $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }


    /**
     * @return mixed
     */
    public function getIdOrganisateur()
    {
        return $this->id_organisateur;
    }

    /**
     * @param mixed $id_organisateur
     */
    public function setIdOrganisateur($id_organisateur)
    {
        $this->id_organisateur = $id_organisateur;
    }


    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getOptActivity()
    {
        return $this->opt_activity;
    }

    /**
     * @param mixed $opt_activity
     */
    public function setOptActivity($opt_activity)
    {
        $this->opt_activity = $opt_activity;
    }

    /**
     * @return mixed
     */
    public function getAccomodation()
    {
        return $this->accomodation;
    }

    /**
     * @param mixed $accomodation
     */
    public function setAccomodation($accomodation)
    {
        $this->accomodation = $accomodation;
    }

    /**
     * @return mixed
     */
    public function getTips()
    {
        return $this->tips;
    }

    /**
     * @param mixed $tips
     */
    public function setTips($tips)
    {
        $this->tips = $tips;
    }

    /**
     * @return mixed
     */
    public function getMaxplace()
    {
        return $this->maxplace;
    }

    /**
     * @param mixed $maxplace
     */
    public function setMaxplace($maxplace)
    {
        $this->maxplace = $maxplace;
    }

    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param mixed $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return mixed
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * @param mixed $datedebut
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;
    }

    /**
     * @return mixed
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * @param mixed $datefin
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }


}