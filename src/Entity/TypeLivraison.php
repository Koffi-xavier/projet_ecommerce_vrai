<?php

namespace App\Entity;

use App\Repository\TypeLivraisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeLivraisonRepository::class)]
class TypeLivraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'paren', targetEntity: Livraisons::class)]
    private Collection $typelivraison;

    public function __construct()
    {
        $this->typelivraison = new ArrayCollection();
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
     * @return Collection<int, Livraisons>
     */
    public function getTypelivraison(): Collection
    {
        return $this->typelivraison;
    }

    public function addTypelivraison(Livraisons $typelivraison): self
    {
        if (!$this->typelivraison->contains($typelivraison)) {
            $this->typelivraison->add($typelivraison);
            $typelivraison->setParen($this);
        }

        return $this;
    }

    public function removeTypelivraison(Livraisons $typelivraison): self
    {
        if ($this->typelivraison->removeElement($typelivraison)) {
            // set the owning side to null (unless already changed)
            if ($typelivraison->getParen() === $this) {
                $typelivraison->setParen(null);
            }
        }

        return $this;
    }
}
