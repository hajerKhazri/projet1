<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $specialite = null;

    #[ORM\Column(type: "array")]
    private array $listePatient = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    // Note: The `setId` method is generally not needed for Doctrine entities
    // because the ID is auto-generated. You can remove it unless you have a specific use case.
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    public function setSpecialite(string $specialite): self
    {
        $this->specialite = $specialite;
        return $this;
    }

    public function getListePatient(): array
    {
        return $this->listePatient;
    }

    public function setListePatient(array $listePatient): self
    {
        $this->listePatient = $listePatient;
        return $this;
    }

    // Add a patient to the list
    public function addPatient(string $patient): self
    {
        if (!in_array($patient, $this->listePatient, true)) {
            $this->listePatient[] = $patient;
        }
        return $this;
    }

    // Remove a patient from the list
    public function removePatient(string $patient): self
    {
        $this->listePatient = array_filter($this->listePatient, fn($p) => $p !== $patient);
        return $this;
    }
}