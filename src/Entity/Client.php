<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="companyname", type="string")
     */
    private $companyname;

    /**
     * @ORM\Column(name="nip", type="integer", length=10)
     */
    private $nip;

    /**
     * @ORM\Column(name="tradeid", type="integer")
     */
    private $tradeid;

    /**
     * @ORM\Column(name="address", type="string")
     */
    private $address;

    /**
     * @ORM\Column(name="city", type="string")
     */
    private $city;

    /**
     * @ORM\Column(name="userid", type="integer")
     */
    private $userid;

    /**
     * @ORM\Column(name="deleted", type="boolean")
     */
    private $deleted;

    public function getId() {
        return $this->id;
    }

    public function getCompanyName(){
        return $this->companyname;
    }
}
