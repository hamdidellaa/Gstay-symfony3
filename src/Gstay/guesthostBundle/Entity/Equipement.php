<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 02/02/2017
 * Time: 22:03
 */

namespace Gstay\guesthostBundle\Entity;



use Doctrine\ORM\Mapping as ORM ;


/**
 * @ORM\Entity
 */
class Equipement
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */

    private $idequipement;

    /**
     * @ORM\ManyToOne(targetEntity="Logement", inversedBy="Equipement")
     * @ORM\JoinColumn(name="idequiplogement", referencedColumnName="idlogement")
     */

    private $idequiplogement;




    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('parking','Ferarepasser','Cintres','Chauffage','Climatisation','Jacuzzi','Piscine','Television','Interphone','Ascenseur','wifi','cuisine')")
     */
    private $euipement;

    /**
     * @return mixed
     */
    public function getIdequipement()
    {
        return $this->idequipement;
    }

    /**
     * @param mixed $idequipement
     */
    public function setIdequipement($idequipement)
    {
        $this->idequipement = $idequipement;
    }



    /**
     * @return mixed
     */
    public function getIdLogement()
    {
        return $this->id_logement;
    }

    /**
     * @param mixed $id_logement
     */
    public function setIdLogement($id_logement)
    {
        $this->id_logement = $id_logement;
    }

    /**
     * @return mixed
     */
    public function getIdequiplogement()
    {
        return $this->idequiplogement;
    }

    /**
     * @param mixed $idequiplogement
     */
    public function setIdequiplogement($idequiplogement)
    {
        $this->idequiplogement = $idequiplogement;
    }

    /**
     * @return mixed
     */
    public function getEuipement()
    {
        return $this->euipement;
    }

    /**
     * @param mixed $euipement
     */
    public function setEuipement($euipement)
    {
        $this->euipement = $euipement;
    }















}