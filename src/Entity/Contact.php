<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */
class Contact
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(name="surname", type="string", length=50)
     */
    private $surname;

    /**
     * @ORM\Column(name="phonenumber", type="integer")
     */
    private $phonenumber;

    /**
     * @ORM\Column(name="email", type="string")
     */
    private $email;

    /**
     * @ORM\Column(name="position", type="string")
     */
    private $position;

    /**
     * @ORM\Column(name="companyid", type="integer")
     */
    private $companyid;

    /**
     * @ORM\Column(name="userid", type="integer")
     */
    private $userid;

    /**
     * @ORM\Column(name="deleted", type="boolean")
     */
    private $deleted;
}
