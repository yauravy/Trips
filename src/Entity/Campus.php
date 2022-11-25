<?php

namespace App\Entity;

use App\Repository\CampusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * @ORM\Entity(repositoryClass=CampusRepository::class)
 */
class Campus
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable="false")
     */
    private $Nom;


    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="campus")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Trip::class, mappedBy="campus")
     */
    private $tripss;
    private $campus;

    public function __toString(){
        return(string) $this->campus; // Remplacer champ par une propriété "string" de l'entité
    }


    public function __construct()
    {

        $this->users = new ArrayCollection();
        $this->tripss = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }


    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setCampus($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCampus() === $this) {
                $user->setCampus(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Trip>
     */
    public function getTripss(): Collection
    {
        return $this->tripss;
    }

    public function addTripss(Trip $tripss): self
    {
        if (!$this->tripss->contains($tripss)) {
            $this->tripss[] = $tripss;
            $tripss->setCampus($this);
        }

        return $this;
    }

    public function removeTripss(Trip $tripss): self
    {
        if ($this->tripss->removeElement($tripss)) {
            // set the owning side to null (unless already changed)
            if ($tripss->getCampus() === $this) {
                $tripss->setCampus(null);
            }
        }

        return $this;
    }

}
