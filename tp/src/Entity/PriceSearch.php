<?php

namespace App\Entity;

use App\Repository\PriceSearchRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PriceSearchRepository::class)
 */
class PriceSearch
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $minPrice;

    /**
     * @ORM\Column(type="float")
     */
    private $maxPrice;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMinPrice(): ?float
    {
        return $this->minPrice;
    }

    public function setMinPrice(float $minPrice): self
    {
        $this->minPrice = $minPrice;

        return $this;
    }

    public function getMaxPrice(): ?float
    {
        return $this->maxPrice;
    }

    public function setMaxPrice(float $maxPrice): self
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }
}
