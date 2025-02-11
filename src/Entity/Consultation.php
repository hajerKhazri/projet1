<?php

namespace App\Entity;

use App\Enum\StatusEnum;
use App\Repository\ConsultationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConsultationRepository::class)]
class Consultation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heure = null;

    #[ORM\Column(enumType: StatusEnum::class)]
    private ?StatusEnum $status = null;

    #[ORM\Column(length: 255)]
    private ?string $traitement = null;

    #[ORM\ManyToOne(inversedBy: 'consultations')]
    private ?Patient $patient = null;

    #[ORM\ManyToOne(inversedBy: 'consultations')]
    private ?Psychiatre $psychiatre = null;

    #[ORM\ManyToOne(inversedBy: 'consultations')]
    private ?RDV $rDV = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getHeure(): ?\DateTimeInterface
    {
        return $this->heure;
    }

    public function setHeure(\DateTimeInterface $heure): static
    {
        $this->heure = $heure;

        return $this;
    }

    public function getStatus(): ?StatusEnum
    {
        return $this->status;
    }

    public function setStatus(StatusEnum $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getTraitement(): ?string
    {
        return $this->traitement;
    }

    public function setTraitement(string $traitement): static
    {
        $this->traitement = $traitement;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): static
    {
        $this->patient = $patient;

        return $this;
    }

    public function getPsychiatre(): ?Psychiatre
    {
        return $this->psychiatre;
    }

    public function setPsychiatre(?Psychiatre $psychiatre): static
    {
        $this->psychiatre = $psychiatre;

        return $this;
    }

    public function getRDV(): ?RDV
    {
        return $this->rDV;
    }

    public function setRDV(?RDV $rDV): static
    {
        $this->rDV = $rDV;

        return $this;
    }
}
