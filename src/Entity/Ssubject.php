<?php

namespace App\Entity;

use App\Repository\SsubjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SsubjectRepository::class)
 */
class Ssubject
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
     * @ORM\ManyToMany(targetEntity=Steacher::class, inversedBy="ssubjects")
     */
    private $steacher_id;

    /**
     * @ORM\OneToMany(targetEntity=Smarks::class, mappedBy="ssubject_id", orphanRemoval=true)
     */
    private $smarks;

    public function __construct()
    {
        $this->steacher_id = new ArrayCollection();
        $this->smarks = new ArrayCollection();
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
     * @return Collection<int, Steacher>
     */
    public function getSteacherId(): Collection
    {
        return $this->steacher_id;
    }

    public function addSteacherId(Steacher $steacherId): self
    {
        if (!$this->steacher_id->contains($steacherId)) {
            $this->steacher_id[] = $steacherId;
        }

        return $this;
    }

    public function removeSteacherId(Steacher $steacherId): self
    {
        $this->steacher_id->removeElement($steacherId);

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
            $smark->setSsubjectId($this);
        }

        return $this;
    }

    public function removeSmark(Smarks $smark): self
    {
        if ($this->smarks->removeElement($smark)) {
            // set the owning side to null (unless already changed)
            if ($smark->getSsubjectId() === $this) {
                $smark->setSsubjectId(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return strval( $this->getName() );
    }
}
