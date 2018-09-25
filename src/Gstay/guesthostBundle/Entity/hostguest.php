<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 04/02/2017
 * Time: 21:28
 */

namespace Gstay\guesthostBundle\Entity;
use AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM ;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @Vich\Uploadable
 */
class hostguest
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id ;

    /**
     * @ORM\Column(type="integer" , nullable=true)
     */
    private $cin;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     */
    private $id_user ;

    /**
     * @ORM\Column(type="string",length=255 , nullable=true)
     */
    private $FirstName;

    /**
     * @ORM\Column(type="string",length=255 , nullable=true)
     */
    private $LastName;

    /**
     * @ORM\Column(type="string",length=255 , nullable=true)
     */
    private $Email;

    /**
     * @ORM\Column(type="integer" , nullable=true)
     */
    private $numTel;

    /**
     * @ORM\Column(type="string",length=255 , nullable=true)
     */
    private $rue;

    /**
     * @ORM\Column(type="integer" , nullable=true)
     */
    private $codePostale;

    /**
     * @ORM\Column(type="string",length=255 , nullable=true)
     */
    private $Emploi;

    /**
     * @ORM\Column(type="string",length=255 , nullable=true)
     */

    private $Country;

    /**
     * @ORM\Column(type="string",length=255 , nullable=true)
     */

    private $Etat;

    /**
     * @ORM\Column(type="date",nullable=true)
     */
    private $dateInscrit;

    /**
     *@ORM\Column(type="string",length=255,options={"default" : "en attente"},nullable=true)
     */
    private $promo;
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="imageName")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="datetime",nullable=true)
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
     * @return hostguest
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
     * @return hostguest
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
    public function getPromo()
    {
        return $this->promo;
    }

    /**
     * @param mixed $promo
     */
    public function setPromo($promo)
    {
        $this->promo = $promo;
    }



    /**
     * @return mixed
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * @param mixed $cin
     */
    public function setCin($cin)
    {
        $this->cin = $cin;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->FirstName;
    }

    /**
     * @param mixed $FirstName
     */
    public function setFirstName($FirstName)
    {
        $this->FirstName = $FirstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->LastName;
    }

    /**
     * @param mixed $LastName
     */
    public function setLastName($LastName)
    {
        $this->LastName = $LastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * @param mixed $Email
     */
    public function setEmail($Email)
    {
        $this->Email = $Email;
    }

    /**
     * @return mixed
     */
    public function getNumTel()
    {
        return $this->numTel;
    }

    /**
     * @param mixed $numTel
     */
    public function setNumTel($numTel)
    {
        $this->numTel = $numTel;
    }

    /**
     * @return mixed
     */
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * @param mixed $rue
     */
    public function setRue($rue)
    {
        $this->rue = $rue;
    }

    /**
     * @return mixed
     */
    public function getCodePostale()
    {
        return $this->codePostale;
    }

    /**
     * @param mixed $codePostale
     */
    public function setCodePostale($codePostale)
    {
        $this->codePostale = $codePostale;
    }

    /**
     * @return mixed
     */
    public function getEmploi()
    {
        return $this->Emploi;
    }

    /**
     * @param mixed $Emploi
     */
    public function setEmploi($Emploi)
    {
        $this->Emploi = $Emploi;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->Country;
    }

    /**
     * @param mixed $Country
     */
    public function setCountry($Country)
    {
        $this->Country = $Country;
    }

    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->Etat;
    }

    /**
     * @param mixed $Etat
     */
    public function setEtat($Etat)
    {
        $this->Etat = $Etat;
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


}