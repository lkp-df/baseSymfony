<?php

namespace App\Entity;

use App\Repository\ArtcleRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArtcleRepository::class)
 */
class Artcle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(
     * min=3, minMessage="il faut au moins trois caracteres",
     * max=50,maxMessage="la désignation doit avoir au moins 5O caractères")
     */
    private $designation;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank
     * @Assert\NotEqualTo(
     * value =  0,
     * message = "le prix ne doit pas etre null")
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
