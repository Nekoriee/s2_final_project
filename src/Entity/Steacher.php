<?php

namespace App\Entity;

use App\Repository\SteacherRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SteacherRepository::class)
 */
class Steacher
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fio;

    /**
     * @ORM\ManyToMany(targetEntity=Ssubject::class, mappedBy="steacher_id")
     */
    private $ssubjects;

    public function __construct()
    {
        $this->ssubjects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFio(): ?string
    {
        return $this->fio;
    }

    public function setFio(string $fio): self
    {
        $this->fio = $fio;

        return $this;
    }

    /**
     * @return Collection<int, Ssubject>
     */
    public function getSsubjects(): Collection
    {
        return $this->ssubjects;
    }

    public function addSsubject(Ssubject $ssubject): self
    {
        if (!$this->ssubjects->contains($ssubject)) {
            $this->ssubjects[] = $ssubject;
            $ssubject->addSteacherId($this);
        }

        return $this;
    }

    public function removeSsubject(Ssubject $ssubject): self
    {
        if ($this->ssubjects->removeElement($ssubject)) {
            $ssubject->removeSteacherId($this);
        }

        return $this;
    }

    public function __toString()
    {
        return strval( $this->getFio() );
    }
}
