<?php

namespace App\Entity;

use App\Repository\TripRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TripRepository::class)
 */
class Trip
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="inserer le nom de la sortie")
     * @Assert\Length(
     *     min=5,
     *     minMessage="5 caractères minimum ",
     *     max=255,
     *     maxMessage="255 caractères minimum"
     *)
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $nom;

    /**
     * @Assert\GreaterThan("today", message="La date de début doit être a partir d'aujourdhui")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateDebut;

    /**
     * @Assert\GreaterThanOrEqual(1, message="La sortie doit durer au moins une heure !")
     * @Assert\LessThanOrEqual(336, message="La sortie doit durer au maximum 336 heures (2 semaines) !")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duree;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateLimiteInscription;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxInscriptions;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $infosSortie;

    /**
     * @ORM\Column(type="string", length=600, nullable=false)
     */
    private $etat;





    /**
     * @ORM\OneToMany(targetEntity=Inscription::class, mappedBy="trip")
     */
    private $inscriptions;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="tripscreated")
     * @ORM\JoinColumn(nullable=false)
     */
    private $creator;

    /**
     * @ORM\ManyToOne(targetEntity=Lieu::class, inversedBy="trips")
     * @ORM\JoinColumn(nullable=true)
     */
    private $lieu;

    /**
     * @ORM\ManyToOne(targetEntity=TripState::class, inversedBy="trips")
     */
    private $tripState;

    /**
     * @ORM\ManyToOne(targetEntity=Campus::class, inversedBy="tripss")
     */
    private $campus;



    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(?int $duree): void
    {
        $this->duree = $duree;

    }

    public function getDateLimiteInscription(): ?\DateTimeInterface
    {
        return $this->dateLimiteInscription;
    }

    public function setDateLimiteInscription(?\DateTimeInterface $dateLimiteInscription): self
    {
        $this->dateLimiteInscription = $dateLimiteInscription;

        return $this;
    }

    public function getMaxInscriptions(): ?int
    {
        return $this->maxInscriptions;
    }

    public function setMaxInscriptions(?int $maxInscriptions): self
    {
        $this->maxInscriptions = $maxInscriptions;

        return $this;
    }

    public function getInfosSortie(): ?string
    {
        return $this->infosSortie;
    }

    public function setInfosSortie(?string $infosSortie): self
    {
        $this->infosSortie = $infosSortie;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }


    /**
     * @return Collection<int, Inscription>
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): self
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions[] = $inscription;
            $inscription->setTrip($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getTrip() === $this) {
                $inscription->setTrip(null);
            }
        }

        return $this;
    }

    public function getLieu(): ?Lieu
    {
        return $this->lieu;
    }

    public function setLieu(?Lieu $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(?User $creator): self
    {
        $this->creator = $creator;

        return $this;
    }

    public function getTripState(): ?TripState
    {
        return $this->tripState;
    }

    public function setTripState(?TripState $tripState): self
    {
        $this->tripState = $tripState;

        return $this;
    }

    public function getCampus(): ?Campus
    {
        return $this->campus;
    }

    public function setCampus(?Campus $campus): self
    {
        $this->campus = $campus;

        return $this;
    }
}
