<?php

namespace App\Entity;

use App\Repository\SmarksRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SmarksRepository::class)
 */
class Smarks
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $mark;

    /**
     * @ORM\ManyToOne(targetEntity=Sstudent::class, inversedBy="smarks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sstudent_id;

    /**
     * @ORM\ManyToOne(targetEntity=Ssubject::class, inversedBy="smarks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ssubject_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMark(): ?string
    {
        return $this->mark;
    }

    public function setMark(string $mark): self
    {
        $this->mark = $mark;

        return $this;
    }

    public function getSstudentId(): ?Sstudent
    {
        return $this->sstudent_id;
    }

    public function setSstudentId(?Sstudent $sstudent_id): self
    {
        $this->sstudent_id = $sstudent_id;

        return $this;
    }

    public function getSsubjectId(): ?Ssubject
    {
        return $this->ssubject_id;
    }

    public function setSsubjectId(?Ssubject $ssubject_id): self
    {
        $this->ssubject_id = $ssubject_id;

        return $this;
    }

    public function __toString()
    {
        return strval( $this->getMark() );
    }
}
