<?php

namespace App\Entity;

use App\Repository\PrixArticlesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrixArticlesRepository::class)]
class PrixArticles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'parentprix', targetEntity: Articles::class)]
    private Collection $prixarticle;

    public function __construct()
    {
        $this->prixarticle = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Articles>
     */
    public function getPrixarticle(): Collection
    {
        return $this->prixarticle;
    }

    public function addPrixarticle(Articles $prixarticle): self
    {
        if (!$this->prixarticle->contains($prixarticle)) {
            $this->prixarticle->add($prixarticle);
            $prixarticle->setParentprix($this);
        }

        return $this;
    }

    public function removePrixarticle(Articles $prixarticle): self
    {
        if ($this->prixarticle->removeElement($prixarticle)) {
            // set the owning side to null (unless already changed)
            if ($prixarticle->getParentprix() === $this) {
                $prixarticle->setParentprix(null);
            }
        }

        return $this;
    }
}
