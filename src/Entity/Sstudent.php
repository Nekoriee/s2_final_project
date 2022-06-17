<?php

namespace App\Entity;

use App\Repository\SstudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SstudentRepository::class)
 */
class Sstudent
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
     * @ORM\ManyToOne(targetEntity=Sclass::class, inversedBy="sstudents")
     */
    private $sclass_id;

    /**
     * @ORM\OneToMany(targetEntity=Smarks::class, mappedBy="sstudent_id", orphanRemoval=true)
     */
    private $smarks;

    public function __construct()
    {
        $this->smarks = new ArrayCollection();
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

    public function getSclassId(): ?Sclass
    {
        return $this->sclass_id;
    }

    public function setSclassId(?Sclass $sclass_id): self
    {
        $this->sclass_id = $sclass_id;

        return $this;
    }

    /**
     * @return Collection<int, Smarks>
     */
    public function getSmarks(): Collection
    {
        return $this->smarks;
    }

    public function addSmark(Smarks $smark): self
    {
        if (!$this->smarks->contains($smark)) {
            $this->smarks[] = $smark;
            $smark->setSstudentId($this);
        }

        return $this;
    }

    public function removeSmark(Smarks $smark): self
    {
        if ($this->smarks->removeElement($smark)) {
            // set the owning side to null (unless already changed)
            if ($smark->getSstudentId() === $this) {
                $smark->setSstudentId(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return strval( $this->getFio() );
    }
}
