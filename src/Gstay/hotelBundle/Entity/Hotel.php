<?php
namespace Gstay\hotelBundle\Entity;

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 02/02/2017
 * Time: 20:56
 */
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Hotel
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     */
    private $id_user ;
    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $name;
    /**
     * @ORM\Column(type="float",nullable=true)
     */
    private $stars;
    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $phone;
    /**
     * @ORM\Column(type="string",length=5000,nullable=true)
     */
    private $langitude;
    /**
     * @ORM\Column(type="string",length=5000,nullable=true)
     */
    private $altitude;
    /**
     * @ORM\Column(type="date",nullable=true)
     */
    private $dateBuilt;
    /**
     * @ORM\Column(type="date")
     */
    private $dateInscrit;
    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $country;
    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $gouvernorat;
    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $adresse;
    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $description;
    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $architecture;
    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $matricule_fiscale;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="imageName")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Hotel
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
     * @return Hotel
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

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
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
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_user
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getStars()
    {
        return $this->stars;
    }

    /**
     * @param mixed $stars
     */
    public function setStars($stars)
    {
        $this->stars = $stars;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getMapLink()
    {
        return $this->map_link;
    }

    /**
     * @param mixed $map_link
     */
    public function setMapLink($map_link)
    {
        $this->map_link = $map_link;
    }

    /**
     * @return mixed
     */
    public function getDateBuilt()
    {
        return $this->dateBuilt;
    }

    /**
     * @param mixed $dateBuilt
     */
    public function setDateBuilt($dateBuilt)
    {
        $this->dateBuilt = $dateBuilt;
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
    public function getArchitecture()
    {
        return $this->architecture;
    }

    /**
     * @param mixed $architecture
     */
    public function setArchitecture($architecture)
    {
        $this->architecture = $architecture;
    }

    /**
     * @return mixed
     */
    public function getMatriculeFiscale()
    {
        return $this->matricule_fiscale;
    }

    /**
     * @param mixed $matricule_fiscale
     */
    public function setMatriculeFiscale($matricule_fiscale)
    {
        $this->matricule_fiscale = $matricule_fiscale;
    }

    /**
     * @return mixed
     */
    public function getDateInscrit()
    {
        return $this->dateInscrit;
    }

    /**
     * @param mixed $dateInscrit
     */
    public function setDateInscrit($dateInscrit)
    {
        $this->dateInscrit = $dateInscrit;
    }



    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getGouvernorat()
    {
        return $this->gouvernorat;
    }

    /**
     * @param mixed $gouvernorat
     */
    public function setGouvernorat($gouvernorat)
    {
        $this->gouvernorat = $gouvernorat;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return mixed
     */
    public function getLangitude()
    {
        return $this->langitude;
    }

    /**
     * @param mixed $langitude
     */
    public function setLangitude($langitude)
    {
        $this->langitude = $langitude;
    }

    /**
     * @return mixed
     */
    public function getAltitude()
    {
        return $this->altitude;
    }

    /**
     * @param mixed $altitude
     */
    public function setAltitude($altitude)
    {
        $this->altitude = $altitude;
    }




}