<?php
/**
 * Created by PhpStorm.
 * User: HD_EXECUTION
 * Date: 10/02/2017
 * Time: 20:02
 */

namespace Gstay\eventBundle\Entity;
use Doctrine\ORM\Mapping as ORM ;


/**
 * @ORM\Entity
 * @ORM\Table(name="days")
 * @ORM\Entity(repositoryClass="Gstay\eventBundle\Entity\EventRepository")
 */
class days
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id ;
    /**
     * @ORM\Column(type="integer")
     */
    private $nbday ;
    /**
     * @ORM\Column(type="string",length=5000,nullable=true)
     */
    private $id_tour ;

    /**
     * @ORM\Column(type="string",length=5000,nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string",length=256,nullable=true)
     */
    private $address;

    /**
     *@ORM\Column(type="float",nullable=true)
     */
    private $latitude;

    /**
     *@ORM\Column(type="float",nullable=true)
     */
    private $longitude;

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
    public function getIdTour()
    {
        return $this->id_tour;
    }

    /**
     * @param mixed $id_tour
     */
    public function setIdTour($id_tour)
    {
        $this->id_tour = $id_tour;
    }

    /**
     * @return mixed
     */
    public function getNbday()
    {
        return $this->nbday;
    }

    /**
     * @param mixed $nbday
     */
    public function setNbday($nbday)
    {
        $this->nbday = $nbday;
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
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
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




}