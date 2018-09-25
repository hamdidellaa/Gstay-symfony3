<?php

namespace Gstay\guesthostBundle\Entity;
use Doctrine\ORM\Mapping as ORM ;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @Vich\Uploadable
 */

class Logement
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */

       private $idlogement;

    /**
     * @ORM\ManyToOne(targetEntity="hostguest", inversedBy="Logement")
     * @ORM\JoinColumn(name="idlogementuser", referencedColumnName="id")
     */

    private $idlogementuser;

    /**
     * @return mixed
     */
    public function getIdlogementuser()
    {
        return $this->idlogementuser;
    }

    /**
     * @param mixed $idlogementuser
     */
    public function setIdlogementuser($idlogementuser)
    {
        $this->idlogementuser = $idlogementuser;
    }


    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     */

     private $nomlogement;

    /**
     *@ORM\Column(type="integer", nullable=true)
     */
    private $capaciteacceuil;


    /**
     *@ORM\Column(type="integer", nullable=true)
     */

    private $nbrchambre;

    /**
     *@ORM\Column(type="integer", nullable=true)
     */

    private $nbrchambredispo;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prix;

    /**
     * @ORM\Column(type="string",length=500, nullable=true)
     */
      private $description;

    /**
     * @return mixed
     */
    public function getNbrchambredispo()
    {
        return $this->nbrchambredispo;
    }

    /**
     * @param mixed $nbrchambredispo
     */
    public function setNbrchambredispo($nbrchambredispo)
    {
        $this->nbrchambredispo = $nbrchambredispo;
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
     * @ORM\Column(type="string",length=255, nullable=true)
     */

    private $disponibilite;

    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     */

     private $adresse;



    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     */

       private $ville;

    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     */

    private $etat;


    /**
     * @ORM\Column(type="integer", nullable=true)
     */

    private $codepostal;

    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     */

    private $image;

    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     */

    private $altitude;

    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     */

    private $longitude;
    /**
     * @ORM\Column(type="date",nullable=true)
     */
    private $dateajout;
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
     * @ORM\Column(type="datetime", nullable=true)
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
     * @return Logement
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
     * @return Logement
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
    public function getDateajout()
    {
        return $this->dateajout;
    }

    /**
     * @param mixed $dateajout
     */
    public function setDateajout($dateajout)
    {
        $this->dateajout = $dateajout;
    }

    /**
     * @return mixed
     */
    public function getIdlogement()
    {
        return $this->idlogement;
    }

    /**
     * @param mixed $idlogement
     */
    public function setIdlogement($idlogement)
    {
        $this->idlogement = $idlogement;
    }



    /**
     * @return mixed
     */
    public function getNomlogement()
    {
        return $this->nomlogement;
    }

    /**
     * @param mixed $nomlogement
     */
    public function setNomlogement($nomlogement)
    {
        $this->nomlogement = $nomlogement;
    }

    /**
     * @return mixed
     */
    public function getCapaciteacceuil()
    {
        return $this->capaciteacceuil;
    }

    /**
     * @param mixed $capaciteacceuil
     */
    public function setCapaciteacceuil($capaciteacceuil)
    {
        $this->capaciteacceuil = $capaciteacceuil;
    }

    /**
     * @return mixed
     */
    public function getNbrchambre()
    {
        return $this->nbrchambre;
    }

    /**
     * @param mixed $nbrchambre
     */
    public function setNbrchambre($nbrchambre)
    {
        $this->nbrchambre = $nbrchambre;
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
    public function getDisponibilite()
    {
        return $this->disponibilite;
    }

    /**
     * @param mixed $disponibilite
     */
    public function setDisponibilite($disponibilite)
    {
        $this->disponibilite = $disponibilite;
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
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param mixed $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return mixed
     */
    public function getCodepostal()
    {
        return $this->codepostal;
    }

    /**
     * @param mixed $codepostal
     */
    public function setCodepostal($codepostal)
    {
        $this->codepostal = $codepostal;
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





}













