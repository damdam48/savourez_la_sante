<?php

namespace App\Entity\Product;

use App\Entity\Categorie;
use App\Entity\Saison;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\Entity\Traits\DateTimeTrait;
use App\Entity\Traits\OnlineTrait;
use App\Repository\Product\RecetteRepository;

#[ORM\Entity(repositoryClass: RecetteRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]
class Recette
{
    use DateTimeTrait;
    use OnlineTrait;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageName = null;

    #[Vich\UploadableField(mapping: 'recette_image', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $listeIngredient = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $preparation = null;

    #[ORM\ManyToOne(inversedBy: 'recettes')]
    private ?Saison $saison = null;

    #[ORM\ManyToOne(inversedBy: 'recettes')]
    private ?Categorie $categorie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }



    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): static
    {
        $this->imageName = $imageName;
        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if ($imageFile) {
            $this->setUpdatedAt(new \DateTime()); // Utiliser le setter du trait
        }
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }


    public function getListeIngredient(): ?string
    {
        return $this->listeIngredient;
    }

    public function setListeIngredient(string $listeIngredient): static
    {
        $this->listeIngredient = $listeIngredient;
        return $this;
    }

    public function getPreparation(): ?string
    {
        return $this->preparation;
    }

    public function setPreparation(string $preparation): static
    {
        $this->preparation = $preparation;
        return $this;
    }

    public function getSaison(): ?Saison
    {
        return $this->saison;
    }

    public function setSaison(?Saison $saison): static
    {
        $this->saison = $saison;
        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }
}
