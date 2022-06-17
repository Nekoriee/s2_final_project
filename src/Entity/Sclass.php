<?php

namespace App\Entity;

use App\Repository\SclassRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SclassRepository::class)
 */
class Sclass
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Sstudent::class, mappedBy="sclass_id")
     */
    private $sstudents;

    public function __construct()
    {
        $this->sstudents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Sstudent>
     */
    public function getSstudents(): Collection
    {
        return $this->sstudents;
    }

    public function addSstudent(Sstudent $sstudent): self
    {
        if (!$this->sstudents->contains($sstudent)) {
            $this->sstudents[] = $sstudent;
            $sstudent->setSclassId($this);
        }

        return $this;
    }

    public function removeSstudent(Sstudent $sstudent): self
    {
        if ($this->sstudents->removeElement($sstudent)) {
            // set the owning side to null (unless already changed)
            if ($sstudent->getSclassId() === $this) {
                $sstudent->setSclassId(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return strval( $this->getName() );
    }
}
