<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticlesRepository::class)]
class Articles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0')]
    private ?string $quantite = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_arrive = null;

    #[ORM\ManyToOne(inversedBy: 'livraison')]
    private ?Livraisons $parent = null;

    #[ORM\ManyToOne(inversedBy: 'fournisseur')]
    private ?Fournisseurs $parentfour = null;

    #[ORM\ManyToOne(inversedBy: 'prixarticle')]
    private ?PrixArticles $parentprix = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: Commande::class)]
    private Collection $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
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

    public function getQuantite(): ?string
    {
        return $this->quantite;
    }

    public function setQuantite(string $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getDateArrive(): ?\DateTimeInterface
    {
        return $this->date_arrive;
    }

    public function setDateArrive(\DateTimeInterface $date_arrive): self
    {
        $this->date_arrive = $date_arrive;

        return $this;
    }

    public function getParent(): ?Livraisons
    {
        return $this->parent;
    }

    public function setParent(?Livraisons $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function getParentfour(): ?Fournisseurs
    {
        return $this->parentfour;
    }

    public function setParentfour(?Fournisseurs $parentfour): self
    {
        $this->parentfour = $parentfour;

        return $this;
    }

    public function getParentprix(): ?PrixArticles
    {
        return $this->parentprix;
    }

    public function setParentprix(?PrixArticles $parentprix): self
    {
        $this->parentprix = $parentprix;

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
     * @return Collection<int, Commande>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Commande $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setArticle($this);
        }

        return $this;
    }

    public function removeArticle(Commande $article): self
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getArticle() === $this) {
                $article->setArticle(null);
            }
        }

        return $this;
    }
}
