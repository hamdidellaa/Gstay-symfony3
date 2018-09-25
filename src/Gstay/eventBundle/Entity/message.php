<?php
/**
 * Created by PhpStorm.
 * User: HD_EXECUTION
 * Date: 16/02/2017
 * Time: 16:23
 */

namespace Gstay\eventBundle\Entity;
use Doctrine\ORM\Mapping as ORM ;

/**
 * @ORM\Entity
 * @ORM\Table(name="message")
 */
class message
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private  $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="message")
     * @ORM\JoinColumn(name="iduser", referencedColumnName="id")
     */
    private $iduser ;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="message")
     * @ORM\JoinColumn(name="idreciver", referencedColumnName="id")
     */
    private $idreciver ;

    /**
     * @ORM\Column(type="string",length=255 , nullable=true)
     */
    private $message;

    /**
     *@ORM\Column(type="string",length=255,options={"default" : "nonlu"})
     */
    private $lu ="nonlu" ;

    /**
     * @ORM\ManyToOne(targetEntity="evenement")
     * @ORM\JoinColumn(name="idevent", referencedColumnName="id")
     */
    private $idevent;
    /**
     * @ORM\ManyToOne(targetEntity="tour")
     * @ORM\JoinColumn(name="idtour", referencedColumnName="id")
     */
    private $idtour;

    /**
     * @ORM\Column(type="datetime" )
     */
    private $date ;

    /**
     * @return mixed
     */
    public function getIdreciver()
    {
        return $this->idreciver;
    }

    /**
     * @param mixed $idreciver
     */
    public function setIdreciver($idreciver)
    {
        $this->idreciver = $idreciver;
    }

    /**
     * message constructor.
     * @param $lu
     */




    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getIdevent()
    {
        return $this->idevent;
    }

    /**
     * @param mixed $idevent
     */
    public function setIdevent($idevent)
    {
        $this->idevent = $idevent;
    }

    /**
     * @return mixed
     */
    public function getIdtour()
    {
        return $this->idtour;
    }

    /**
     * @param mixed $idtour
     */
    public function setIdtour($idtour)
    {
        $this->idtour = $idtour;
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
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * @param mixed $iduser
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getLu()
    {
        return $this->lu;
    }

    /**
     * @param mixed $lu
     */
    public function setLu($lu)
    {
        $this->lu = $lu;
    }



}