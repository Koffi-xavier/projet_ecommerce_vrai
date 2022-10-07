<?php

namespace App\Entity;

use App\Repository\LivraisonsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivraisonsRepository::class)]
class Livraisons
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_livraison = null;

    #[ORM\Column(length: 100)]
    private ?string $lieu_livraison = null;

    #[ORM\Column(length: 1, nullable: true)]
    private ?string $parent = null;

    #[ORM\ManyToOne(inversedBy: 'livreur')]
    private ?Livreurs $parents = null;

    #[ORM\ManyToOne(inversedBy: 'typelivraison')]
    private ?TypeLivraison $paren = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: Articles::class)]
    private Collection $livraison;

    public function __construct()
    {
        $this->livraison = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateLivraison(): ?\DateTimeInterface
    {
        return $this->date_livraison;
    }

    public function setDateLivraison(\DateTimeInterface $date_livraison): self
    {
        $this->date_livraison = $date_livraison;

        return $this;
    }

    public function getLieuLivraison(): ?string
    {
        return $this->lieu_livraison;
    }

    public function setLieuLivraison(string $lieu_livraison): self
    {
        $this->lieu_livraison = $lieu_livraison;

        return $this;
    }

    public function getParent(): ?string
    {
        return $this->parent;
    }

    public function setParent(?string $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function getParents(): ?Livreurs
    {
        return $this->parents;
    }

    public function setParents(?Livreurs $parents): self
    {
        $this->parents = $parents;

        return $this;
    }

    public function getParen(): ?TypeLivraison
    {
        return $this->paren;
    }

    public function setParen(?TypeLivraison $paren): self
    {
        $this->paren = $paren;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection<int, Articles>
     */
    public function getLivraison(): Collection
    {
        return $this->livraison;
    }

    public function addLivraison(Articles $livraison): self
    {
        if (!$this->livraison->contains($livraison)) {
            $this->livraison->add($livraison);
            $livraison->setParent($this);
        }

        return $this;
    }

    public function removeLivraison(Articles $livraison): self
    {
        if ($this->livraison->removeElement($livraison)) {
            // set the owning side to null (unless already changed)
            if ($livraison->getParent() === $this) {
                $livraison->setParent(null);
            }
        }

        return $this;
    }
}
