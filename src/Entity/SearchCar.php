<?php


namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class SearchCar
{
    #[Assert\LessThanOrEqual(propertyPath:"maxYear", message:"doit être plus petit que l'année maximum")]
    private ?int $minYear = null;

    #[Assert\GreaterThanOrEqual(propertyPath:"minYear", message:"doit être plus grand que l'année minimum")]
    private ?int $maxYear = null;

    public function getMinYear(): int|null
    {
        return $this->minYear;
    }

    public function setMinYear($minYear): self
    {
        $this->minYear = $minYear;
        return $this;
    }

    public function getMaxYear(): int|null
    {
        return $this->maxYear;
    }

    public function setMaxYear($maxYear): self
    {
        $this->maxYear = $maxYear;
        return $this;
    }

}