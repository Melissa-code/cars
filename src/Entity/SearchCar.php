<?php


namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class SearchCar
{
    #[Assert\LessThanOrEqual(propertyPath:"maxYear", message:"doit être plus petit que l'année maximum")]
    private int $minYear;

    #[Assert\GreaterThanOrEqual(propertyPath:"minYear", message:"doit être plus grand que l'année minimum")]
    private  int $maxYear;

    public function getMinYear(): int
    {
        return $this->minYear;
    }

    public function setMinYear($minYear): self
    {
        $this->minYear = $minYear;
        return $this;
    }

    public function getMaxYear(): int
    {
        return $this->maxYear;
    }

    public function setMaxYear($maxYear): self
    {
        $this->maxYear = $maxYear;
        return $this;
    }

}