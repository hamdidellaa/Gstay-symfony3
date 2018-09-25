<?php

namespace Gstay\eventBundle\Entity;
use AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM ;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 * Created by PhpStorm.
 * User: HD_EXECUTION
 * Date: 01/02/2017
 * Time: 22:56
 */

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Gstay\eventBundle\Entity\EventRepository")
 * @Vich\Uploadable
 */
class evenement
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id ;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="evenement")
     * @ORM\JoinColumn(name="id_organisateur", referencedColumnName="id")
     */
    private $id_organisateur ;


    /**
     * @ORM\ManyToOne(targetEntity="profile", inversedBy="evenement")
     * @ORM\JoinColumn(name="id_profile", referencedColumnName="id")
     */
    private $id_profile ;


    /**
     * @ORM\ManyToOne(targetEntity="Gstay\hotelBundle\Entity\Hotel",inversedBy="evenement" )
     * @ORM\JoinColumn(name="hotel", referencedColumnName="id")
     */
    private $hotel;

    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $titre;

    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $type;
    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $theme;
    /**
     * @ORM\Column(type="string",length=10000,nullable=true)
     */
    private $planing;

    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $addess;
    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $ville;
    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $gouvernerat;

    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $code_postal;


    /**
     * @ORM\Column(type="date",nullable=true)
     */
    private $date_debut;
    /**
     * @ORM\Column(type="date",nullable=true)
     */
    private $date_fin;


    /**
     * @ORM\Column(type="string", length=255 ,nullable=true)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $lien_fb;

    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $lien_youtube;



    /**
     *@ORM\Column(type="integer",nullable=true)
     */
    private $nb_ticket;

    /**
     * @ORM\Column(type="float",nullable=true)
     */
    private $prix;


    /**
     *@ORM\Column(type="string",length=255,options={"default" : "en attente"})
     */
    private $comfirm_hotel;

    /**
     *@ORM\Column(type="float",nullable=true)
     */
    private $latitude;

    /**
     *@ORM\Column(type="float",nullable=true)
     */
    private $longitude;



    /**
     *@ORM\Column(type="string",length=255,options={"default" : "actif"})
     */
    private $statut;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="imageName")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;


    /**
     *@ORM\Column(type="integer",nullable=true,options={"default" : "0"})
     */
    private $ticketvendu;



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
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
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
    public function getHotel()
    {
        return $this->hotel;
    }

    /**
     * @param mixed $hotel
     */
    public function setHotel($hotel)
    {
        $this->hotel = $hotel;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * @param mixed $theme
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;
    }

    /**
     * @return mixed
     */
    public function getPlaning()
    {
        return $this->planing;
    }

    /**
     * @param mixed $planing
     */
    public function setPlaning($planing)
    {
        $this->planing = $planing;
    }

    /**
     * @return mixed
     */
    public function getAddess()
    {
        return $this->addess;
    }

    /**
     * @param mixed $addess
     */
    public function setAddess($addess)
    {
        $this->addess = $addess;
    }

    /**
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    /**
     * @return mixed
     */
    public function getGouvernerat()
    {
        return $this->gouvernerat;
    }

    /**
     * @param mixed $gouvernerat
     */
    public function setGouvernerat($gouvernerat)
    {
        $this->gouvernerat = $gouvernerat;
    }

    /**
     * @return mixed
     */
    public function getCodePostal()
    {
        return $this->code_postal;
    }

    /**
     * @param mixed $code_postal
     */
    public function setCodePostal($code_postal)
    {
        $this->code_postal = $code_postal;
    }

    /**
     * @return mixed
     */
    public function getDateDebut()
    {
        return $this->date_debut;
    }

    /**
     * @param mixed $date_debut
     */
    public function setDateDebut($date_debut)
    {
        $this->date_debut = $date_debut;
    }

    /**
     * @return mixed
     */
    public function getDateFin()
    {
        return $this->date_fin;
    }

    /**
     * @param mixed $date_fin
     */
    public function setDateFin($date_fin)
    {
        $this->date_fin = $date_fin;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getLienFb()
    {
        return $this->lien_fb;
    }

    /**
     * @param mixed $lien_fb
     */
    public function setLienFb($lien_fb)
    {
        $this->lien_fb = $lien_fb;
    }





    /**
     * @return mixed
     */
    public function getNbTicket()
    {
        return $this->nb_ticket;
    }

    /**
     * @param mixed $nb_ticket
     */
    public function setNbTicket($nb_ticket)
    {
        $this->nb_ticket = $nb_ticket;
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
    public function getComfirmHotel()
    {
        return $this->comfirm_hotel;
    }

    /**
     * @param mixed $comfirm_hotel
     */
    public function setComfirmHotel($comfirm_hotel)
    {
        $this->comfirm_hotel = $comfirm_hotel;
    }




    /**
     * @return mixed
     */
    public function getLienYoutube()
    {
        return $this->lien_youtube;
    }

    /**
     * @param mixed $lien_youtube
     */
    public function setLienYoutube($lien_youtube)
    {
        $this->lien_youtube = $lien_youtube;
    }

    /**
     * @return mixed
     */
    public function getIdProfile()
    {
        return $this->id_profile;
    }

    /**
     * @param mixed $id_profile
     */
    public function setIdProfile($id_profile)
    {
        $this->id_profile = $id_profile;
    }




}

