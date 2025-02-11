<?php

namespace App\Entity;

use App\Repository\PsychiatreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PsychiatreRepository::class)]
class Psychiatre extends User
{
  
    #[ORM\Column(length: 255)]
    private ?string $specialite = null;

    /**
     * @var Collection<int, RDV>
     */
    #[ORM\OneToMany(targetEntity: RDV::class, mappedBy: 'psychiatre')]
    private Collection $rdv;

    /**
     * @var Collection<int, Consultation>
     */
    #[ORM\OneToMany(targetEntity: Consultation::class, mappedBy: 'psychiatre')]
    private Collection $consultations;

    public function __construct()
    {
        $this->rdv = new ArrayCollection();
        $this->consultations = new ArrayCollection();
    }



    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    public function setSpecialite(string $specialite): static
    {
        $this->specialite = $specialite;

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
            $rdv->setPsychiatre($this);
        }

        return $this;
    }

    public function removeRdv(RDV $rdv): static
    {
        if ($this->rdv->removeElement($rdv)) {
            // set the owning side to null (unless already changed)
            if ($rdv->getPsychiatre() === $this) {
                $rdv->setPsychiatre(null);
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
            $consultation->setPsychiatre($this);
        }

        return $this;
    }

    public function removeConsultation(Consultation $consultation): static
    {
        if ($this->consultations->removeElement($consultation)) {
            // set the owning side to null (unless already changed)
            if ($consultation->getPsychiatre() === $this) {
                $consultation->setPsychiatre(null);
            }
        }

        return $this;
    }
}
