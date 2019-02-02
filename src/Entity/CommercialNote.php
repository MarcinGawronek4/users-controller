<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommercialNoteRepository")
 */
class CommercialNote
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="content", type="string")
     */
    private $content;

    /**
     * @ORM\Column(name="deleted", type="boolean")
     */
    private $deleted;

    /**
     * @ORM\Column(name="companyid", type="integer")
     */
    private $companyid;

    /**
     * @ORM\Column(name="userid", type="integer")
     */
    private $userid;

}
