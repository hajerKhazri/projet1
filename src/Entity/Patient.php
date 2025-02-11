<?php

namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PatientRepository::class)]
class Patient extends User
{
   

    #[ORM\Column(length: 255)]
    private ?string $dossierMedical = null;

    /**
     * @var Collection<int, RDV>
     */
    #[ORM\OneToMany(targetEntity: RDV::class, mappedBy: 'patient')]
    private Collection $rdv;

    /**
     * @var Collection<int, Consultation>
     */
    #[ORM\OneToMany(targetEntity: Consultation::class, mappedBy: 'patient')]
    private Collection $consultations;

    public function __construct()
    {
        $this->rdv = new ArrayCollection();
        $this->consultations = new ArrayCollection();
    }



    public function getDossierMedical(): ?string
    {
        return $this->dossierMedical;
    }

    public function setDossierMedical(string $dossierMedical): static
    {
        $this->dossierMedical = $dossierMedical;

        return $this;
    }

    /**
     * @return Collection<int, RDV>
     */
    public function getRdv(): Collection
    {
        return $this->rdv;
    }

    public function addRdv(RDV $rdv): static
    {
        if (!$this->rdv->contains($rdv)) {
            $this->rdv->add($rdv);
            $rdv->setPatient($this);
        }

        return $this;
    }

    public function removeRdv(RDV $rdv): static
    {
        if ($this->rdv->removeElement($rdv)) {
            // set the owning side to null (unless already changed)
            if ($rdv->getPatient() === $this) {
                $rdv->setPatient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Consultation>
     */
    public function getConsultations(): Collection
    {
        return $this->consultations;
    }

    public function addConsultation(Consultation $consultation): static
    {
        if (!$this->consultations->contains($consultation)) {
            $this->consultations->add($consultation);
            $consultation->setPatient($this);
        }

        return $this;
    }

    public function removeConsultation(Consultation $consultation): static
    {
        if ($this->consultations->removeElement($consultation)) {
            // set the owning side to null (unless already changed)
            if ($consultation->getPatient() === $this) {
                $consultation->setPatient(null);
            }
        }

        return $this;
    }
}
